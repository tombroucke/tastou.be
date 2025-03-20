<?php

namespace Tastou\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Tastou\Console\FieldCommand;
use Tastou\Console\OptionsPageCommand;
use Tastou\Console\PostTypeCommand;
use Tastou\Console\SeedCommand;
use Tastou\Console\ShortcodeCommand;
use Tastou\Console\TaxonomyCommand;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('tastou.base_path', function () {
            return realpath(__DIR__.'/../');
        });

        $this->app->singleton('tastou.locale', function () {
            return new \Tastou\Services\Locale;
        });

        $this->app->singleton('tastou.opening_hours', function () {
            return new \Tastou\OpeningHours;
        });
    }

    public function boot()
    {
        $this->commands([
            PostTypeCommand::class,
            TaxonomyCommand::class,
            OptionsPageCommand::class,
            FieldCommand::class,
            ShortcodeCommand::class,
            SeedCommand::class,
        ]);

        $this->loadViewsFrom(
            __DIR__.'/../../resources/views',
            'Tastou',
        );

        $this->loadTextdomain();
        $this->initPostTypes();
        $this->initOptionsPages();
        $this->initFields();
        $this->initShortcodes();

        Str::macro('phoneLink', function ($phone) {
            return Str::of($phone)
                ->replace(['(0)', '+'], ['', '00'])
                ->replaceMatches('/[^0-9]/', '')
                ->prepend('tel:');
        });

        Str::macro('emailLink', function ($email) {
            return Str::of(antispambot($email))
                ->prepend('mailto:');
        });
    }

    private function loadTextdomain()
    {
        add_action('init', function () {
            $muPluginRelPath = dirname(plugin_basename(__FILE__), 3).'/resources/languages/';
            load_muplugin_textdomain('tastou', $muPluginRelPath);
        }, 0);
    }

    private function initPostTypes()
    {
        collect([
            'PostTypes',
            'Taxonomies',
        ])->each(function ($registerableClassPath) {
            $this
                ->collectFilesIn("/$registerableClassPath")
                ->each(function ($filename) {
                    add_action('init', function () use ($filename) {
                        $className = $this->namespacedClassNameFromFilename($filename);
                        (new $className)
                            ->register();
                    });
                });
        });
    }

    private function initOptionsPages()
    {
        $this
            ->collectFilesIn('/OptionsPages')
            ->each(function ($filename) {
                add_action('acf/init', function () use ($filename) {
                    $className = $this->namespacedClassNameFromFilename($filename);
                    (new $className)
                        ->register();
                });
            });
    }

    private function initFields()
    {
        $this
            ->collectFilesIn('/Fields')
            ->each(function ($filename) {
                add_action('acf/init', function () use ($filename) {
                    $className = $this->namespacedClassNameFromFilename($filename);
                    (new $className)
                        ->register();
                });
            });
    }

    private function initShortcodes()
    {
        $this
            ->collectFilesIn('/Shortcodes')
            ->each(function ($filename) {
                $className = $this->namespacedClassNameFromFilename($filename);
                add_shortcode($className::SHORTCODE_NAME, [new $className, 'callback']);
            });
    }

    private function collectFilesIn($path)
    {
        $fullPath = app('tastou.base_path')."/$path";

        return collect(array_merge(
            glob("$fullPath/*.php"),
            glob("$fullPath/**/*.php")
        ));
    }

    private function namespacedClassNameFromFilename($filename)
    {
        return Str::of($filename)
            ->replace(app('tastou.base_path'), '')
            ->ltrim('/')
            ->replace('/', '\\')
            ->rtrim('.php')
            ->prepend('\\Tastou\\')
            ->__toString();
    }
}

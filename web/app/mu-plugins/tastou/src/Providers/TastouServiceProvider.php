<?php

namespace Tastou\Providers;

use Illuminate\Support\ServiceProvider;
use Tastou\Admin;
use Tastou\Frontend;

class TastouServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('tastou.frontend', function () {
            return new \Tastou\Frontend;
        });

        $this->app->singleton('tastou.admin', function () {
            return new \Tastou\Admin;
        });

        $this->app->singleton('tastou.contact_information', function () {
            return new \Tastou\ContactInformation;
        });

        $this->app->singleton('tastou.social_media', function () {
            return new \Tastou\SocialMedia;
        });
    }

    public function boot()
    {
        collect([
            Frontend::class,
            Admin::class,
        ])
            ->each(function ($class) {
                (new $class)->runHooks();
            });
    }
}

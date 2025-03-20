<?php

namespace Tastou\PostTypes;

use Tastou\Concerns\HasHooks;
use Tastou\Contracts\PostType;
use Tastou\Exceptions\ExtendedCptsNotInstalledException;
use Tastou\Services\Labels;

class Recipe implements PostType
{
    use HasHooks;

    const POST_TYPE = 'recipe';

    public function register(): void
    {
        if (! function_exists('register_extended_post_type')) {
            throw new ExtendedCptsNotInstalledException;
        }

        $postSingularName = __('Recipe', 'tastou');
        $postPluralName = __('Recipes', 'tastou');

        $args = [
            'show_in_feed' => true,
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-carrot',
            'labels' => Labels::postType($postSingularName, $postPluralName),
            'dashboard_activity' => true,
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions'],
            'admin_cols' => [
                'recipe_featured_image' => [
                    'title' => __('Featured image', 'tastou'),
                    'featured_image' => 'thumbnail',
                ],
            ],

        ];

        $names = [
            'singular' => $postSingularName,
            'plural' => $postPluralName,
            'slug' => 'recipe',
        ];

        register_extended_post_type(self::POST_TYPE, $args, $names);
    }
}

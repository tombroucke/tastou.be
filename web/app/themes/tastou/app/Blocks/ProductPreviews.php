<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Log1x\AcfComposer\Builder;
use Otomaties\AcfObjects\Facades\AcfObjects;

class ProductPreviews extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Product Previews';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Show products next to eachother';

    /**
     * The block category.
     *
     * @var string
     */
    public $category = 'theme';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'editor-ul';

    /**
     * The block keywords.
     *
     * @var array
     */
    public $keywords = [];

    /**
     * The block post type allow list.
     *
     * @var array
     */
    public $post_types = ['page', 'product'];

    /**
     * The parent block type allow list.
     *
     * @var array
     */
    public $parent = [];

    /**
     * The ancestor block type allow list.
     *
     * @var array
     */
    public $ancestor = [];

    /**
     * The default block mode.
     *
     * @var string
     */
    public $mode = 'preview';

    /**
     * The default block alignment.
     *
     * @var string
     */
    public $align = 'wide';

    /**
     * The default block text alignment.
     *
     * @var string
     */
    public $align_text = '';

    /**
     * The default block content alignment.
     *
     * @var string
     */
    public $align_content = '';

    /**
     * The default block spacing.
     *
     * @var array
     */
    public $spacing = [
        'padding' => null,
        'margin' => null,
    ];

    /**
     * The supported block features.
     *
     * @var array
     */
    public $supports = [
        'align' => ['wide'],
        'align_text' => false,
        'align_content' => false,
        'full_height' => false,
        'anchor' => false,
        'mode' => true,
        'multiple' => true,
        'jsx' => false,
        'color' => [
            'background' => false,
            'text' => false,
            'gradients' => false,
        ],
        'spacing' => [
            'padding' => false,
            'margin' => false,
        ],
    ];

    /**
     * Data to be passed to the block before rendering.
     */
    public function with(): array
    {
        $settings = AcfObjects::getField('settings')
            ->default([
                'extended_previews' => false,
            ]);

        return [
            'products' => AcfObjects::getField('products'),
            'extendedPreviews' => $settings['extended_previews']
        ];
    }

    /**
     * The block field group.
     */
    public function fields(): array
    {
        $fields = Builder::make('product_previews');

        $fields
            ->addRelationship('products', [
                'label' => 'Products',
                'post_type' => ['product'],
            ])
            ->addGroup('settings', [
                'label' => 'Settings',
            ])
                ->addTrueFalse('extended_previews', [
                    'label' => __('Extended previews', 'sage'),
                    'instructions' => __('Show more information', 'sage'),
                    'default_value' => false,
                ])
            ->endGroup();


        return $fields->build();
    }
}

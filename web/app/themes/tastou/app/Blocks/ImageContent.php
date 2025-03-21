<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Log1x\AcfComposer\Builder;
use Otomaties\AcfObjects\Facades\AcfObjects;

class ImageContent extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Image Content';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'A simple Image Content block.';

    /**
     * The block category.
     *
     * @var string
     */
    public $category = 'formatting';

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
    public $post_types = [];

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
    public $align = '';

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
     * The supported block features.
     *
     * @var array
     */
    public $supports = [
        'align' => false,
        'align_text' => false,
        'align_content' => true,
        'full_height' => false,
        'anchor' => false,
        'mode' => false,
        'multiple' => true,
        'jsx' => true,
        'color' => [
            'background' => true,
        ],
    ];

    /**
     * Data to be passed to the block before rendering.
     */
    public function with(): array
    {
        $settings = AcfObjects::getField('settings')
            ->default([
                'image_position' => 'left',
                'stretch_image' => 'false',
            ]);
        $imagePosition = $settings->get('image_position');

        $verticalAlign = match ($this->block->alignContent ?? 'top') {
            'center' => 'center',
            'top' => 'start',
            'bottom' => 'end',
            default => 'start',
        };

        return [
            'verticalAlign' => $verticalAlign,
            'image' => AcfObjects::getField('image'),
            'imageGridColumn' => $imagePosition == 'left' ? '2 / span 5' : '7 / span 5',
            'contentGridColumn' => $imagePosition == 'left' ? '7 / span 5' : '2 / span 5',
            'imageClasses' => $settings->get('stretch_image') ? ['h-100', 'object-fit-cover'] : [],
            'stretchImage' => $settings->get('stretch_image'),
            'label' => $settings->get('label'),
        ];
    }

    /**
     * The block field group.
     */
    public function fields(): array
    {
        $fields = Builder::make('image_content');

        $fields
            ->addImage('image', [
                'label' => __('Image', 'sage'),
                'required' => true,
                'preview_size' => 'thumbnail',
                'instructions' => __('Upload an image', 'sage'),
            ])
            ->addGroup('settings', [
                'label' => __('Settings', 'sage'),
                'layout' => 'block',
            ])
            ->addImage('label', [
                'label' => __('Label', 'sage'),
                'instructions' => __('Optional label for this block', 'sage'),
            ])
            ->addSelect('image_position', [
                'label' => __('Image Position', 'sage'),
                'allow_null' => true,
                'choices' => [
                    'left' => __('Left', 'sage'),
                    'right' => __('Right', 'sage'),
                ],
            ])
            ->addTrueFalse('stretch_image', [
                'label' => __('Stretch Image', 'sage'),
                'instructions' => __('Stretch the image to the full height of the block', 'sage'),
                'default_value' => false,
            ])
            ->endGroup();

        return $fields->build();
    }
}

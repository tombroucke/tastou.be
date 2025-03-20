<?php

namespace Tastou\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;
use Tastou\Abstracts\Field;

class Product extends Field
{
    protected function fields(): FieldsBuilder
    {
        $fieldsBuilder = new FieldsBuilder('product', [
            'title' => __('Product', 'tastou'),
        ]);

        $fieldsBuilder
            ->setLocation('post_type', '==', 'product');

        $fieldsBuilder
            ->addWysiwyg('short_description', [
                'label' => __('Short description', 'sage'),
                'required' => false,
                'instructions' => __('This will be showed on product previews', 'sage'),
                'media_upload' => false,
                'toolbar' => 'basic',
            ])
            ->addColorPicker('color', [
                'label' => __('Color', 'tastou'),
                'required' => 1,
            ]);

        return $fieldsBuilder;
    }
}

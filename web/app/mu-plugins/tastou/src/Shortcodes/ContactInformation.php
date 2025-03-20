<?php

namespace Tastou\Shortcodes;

use Illuminate\Support\Str;
use Tastou\Contracts\Shortcode;

class ContactInformation implements Shortcode
{
    const SHORTCODE_NAME = 'contact-information';

    /**
     * Shortcode callback
     *
     * @param  array<string, mixed>|string  $atts  The shortcode attributes.
     */
    public function callback(array|string $atts = []): string
    {
        $a = shortcode_atts(
            [
                'property' => '',
            ],
            $atts
        );
        $property = Str::of($a['property'])
            ->replace(' ', '')
            ->toString();

        return view('Tastou::shortcodes.contact-information', [
            'property' => $property ?: null,
        ])->toHtml();
    }
}

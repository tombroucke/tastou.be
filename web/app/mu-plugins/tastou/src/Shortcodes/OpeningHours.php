<?php

namespace Tastou\Shortcodes;

use Tastou\Contracts\Shortcode;

class OpeningHours implements Shortcode
{
    const SHORTCODE_NAME = 'opening-hours';

    /**
     * Shortcode callback
     *
     * @param  array<string, mixed>|string  $atts  The shortcode attributes.
     */
    public function callback(array|string $atts = []): string
    {
        return view('Tastou::shortcodes.opening-hours', [
            'schedule' => app()->make('tastou.opening_hours')->schedule(),
        ])->toHtml();
    }
}

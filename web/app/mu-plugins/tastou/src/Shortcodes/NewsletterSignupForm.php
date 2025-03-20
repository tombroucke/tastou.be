<?php

namespace Tastou\Shortcodes;

use Tastou\Contracts\Shortcode;

class NewsletterSignupForm implements Shortcode
{
    const SHORTCODE_NAME = 'newsletter-signup-form';

    /**
     * Shortcode callback
     *
     * @param  array<string, mixed>|string  $atts  The shortcode attributes.
     */
    public function callback(array|string $atts = []): string
    {
        $signupForm = get_field('newsletter_signup_form', 'option');

        return view('Tastou::shortcodes.newsletter-signup-form', [
            'signupForm' => $signupForm,
        ])->toHtml();
    }
}

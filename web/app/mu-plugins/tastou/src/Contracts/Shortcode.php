<?php

namespace Tastou\Contracts;

interface Shortcode
{
    public function callback(array|string $atts = []): string;
}

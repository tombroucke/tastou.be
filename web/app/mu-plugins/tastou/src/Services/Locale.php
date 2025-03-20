<?php

namespace Tastou\Services;

use Illuminate\Support\Collection;

class Locale
{
    /**
     * Get weekdays
     */
    public function weekDays(): Collection
    {
        global $wp_locale;
        $days = collect($wp_locale->weekday);
        if (get_option('start_of_week') == 1) {
            $days->push($days->shift());
        }

        return $days;
    }
}

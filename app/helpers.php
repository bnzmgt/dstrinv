<?php

use Carbon\Carbon;

if (! function_exists('money')) {
    /**
     * Format number as Indonesian Rupiah.
     */
    function money(
        int|float|string|null $amount,
        string $prefix = 'Rp'
    ): string {
        return sprintf(
            '%s %s',
            $prefix,
            number_format((float) ($amount ?? 0), 0, ',', '.')
        );
    }
}

if (! function_exists('display_date')) {
    /**
     * Format date for display.
     */
    function display_date(
        Carbon|string|null $date,
        string $format = 'd M Y'
    ): string {
        if (blank($date)) {
            return '-';
        }

        return Carbon::parse($date)->format($format);
    }
}
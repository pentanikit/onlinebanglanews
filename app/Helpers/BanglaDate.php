<?php

namespace App\Helpers;

use Carbon\Carbon;

class BanglaDate
{
    public static function format($date)
    {
        if (!$date) return null;

        // Bangla month names
        $months = [
            1 => 'জানুয়ারি',
            2 => 'ফেব্রুয়ারি',
            3 => 'মার্চ',
            4 => 'এপ্রিল',
            5 => 'মে',
            6 => 'জুন',
            7 => 'জুলাই',
            8 => 'আগস্ট',
            9 => 'সেপ্টেম্বর',
            10 => 'অক্টোবর',
            11 => 'নভেম্বর',
            12 => 'ডিসেম্বর'
        ];

        // Convert English digits to Bangla digits
        $en = ['0','1','2','3','4','5','6','7','8','9'];
        $bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];

        $carbon = Carbon::parse($date);

        $day = str_replace($en, $bn, $carbon->format('j'));
        $month = $months[$carbon->format('n')];
        $year = str_replace($en, $bn, $carbon->format('Y'));

        return "{$day} {$month} {$year} প্রকাশিত";
    }
}

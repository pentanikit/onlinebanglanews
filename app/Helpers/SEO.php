<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;


if (!function_exists('seo_setting')) {
    function seo_setting($key, $default = null)
    {
        // সব settings cache করে রাখি
        $settings = Cache::rememberForever('settings_cache', function () {
            return Setting::pluck('value', 'key')->toArray();
        });

        return $settings[$key] ?? $default;
    }
}

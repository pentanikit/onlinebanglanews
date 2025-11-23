<?php

use App\Models\Media;
use Illuminate\Support\Facades\Cache;
use App\Models\AdBlock;

if (! function_exists('media_setting')) {
    function media_setting(string $type, $default = null)
    {
        $cacheKey = "media_setting_{$type}";

        return Cache::rememberForever($cacheKey, function () use ($type, $default) {

            $media = Media::where('alt_text', $type)->first();

            if (! $media) {
                if ($default) {
                    return $default;
                }

                return asset(
                    $type === 'favicon'
                        ? 'images/default-favicon.png'
                        : 'images/default-logo.png'
                );
            }
            

            return asset('storage/'.$media->file_path); // adjust column if needed
        });
    }
}

if (! function_exists('logo')) {
    function logo($default = null)
    {
        return media_setting('logo', $default);
    }
}

if (! function_exists('favicon')) {
    function favicon($default = null)
    {
        return media_setting('favicon', $default);
    }
}

if (! function_exists('settings')) {
    function settings($key = null, $default = null)
    {
        if (is_null($key)) {
            return config('app_settings', []);
        }

        if (in_array($key, ['logo', 'favicon'])) {
            return media_setting($key, $default);
        }

        return config("app_settings.{$key}", $default);
    }



    //ads
    if (!function_exists('ad_block')) {
    /**
     * Get a single AdBlock by slot & position.
     */
    function ad_block(int $slot, string $positionKey = 'home_sidebar')
    {
        return AdBlock::where('position_key', $positionKey)
            ->where('slot', $slot)
            ->where('is_active', true)
            ->first();
    }
    }

    if (!function_exists('ad1')) {
        function ad1(string $positionKey = 'home_sidebar')
        {
            return ad_block(1, $positionKey);
        }
    }

    if (!function_exists('ad2')) {
        function ad2(string $positionKey = 'home_sidebar')
        {
            return ad_block(2, $positionKey);
        }
    }

    if (!function_exists('ad3')) {
        function ad3(string $positionKey = 'home_sidebar')
        {
            return ad_block(3, $positionKey);
        }
    }

    if (!function_exists('ad4')) {
        function ad4(string $positionKey = 'home_sidebar')
        {
            return ad_block(4, $positionKey);
        }
    }

    if (!function_exists('ad5')) {
        function ad5(string $positionKey = 'home_sidebar')
        {
            return ad_block(5, $positionKey);
        }
    }

    if (!function_exists('ad6')) {
        function ad6(string $positionKey = 'home_sidebar')
        {
            return ad_block(6, $positionKey);
        }
    }
}

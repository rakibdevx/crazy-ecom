<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

if (!function_exists('setting')) {
    function setting($key , $default = null)
    {
        $settings = Cache::rememberForever('settings_cache', function () {
            return DB::table('settings')->pluck('value', 'key')->toArray();
        });

        return $settings[$key] ?? $default;
    }
}

if (!function_exists('clearSettingCache')) {
    function clearSettingCache()
    {
        Cache::forget('settings_cache');
    }
}

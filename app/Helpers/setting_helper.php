<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


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


if (!function_exists('format_date')) {
    function format_date($value)
    {
        if (!$value) {
            return null;
        }

        $format = setting('date_format') ?? 'd-m-Y';
        return Carbon::parse($value)->format($format);
    }
}

if (!function_exists('format_time')) {
    function format_time($value)
    {
        if (!$value) {
            return null;
        }

        $format = setting('time_format') ?? 'H:i:s';
        return Carbon::parse($value)->format($format);
    }
}

<?php

namespace App\Helpers\Classes;

use App\Models\Setting;

class Helper
{
    public static function multi_explode($delimiters, $string): array
    {

        $ready  = str_replace($delimiters, $delimiters[0], $string);

        $ready  = str_replace(array(',,'),',', $ready);

        $ready  = str_replace('-','', $ready);

        return explode($delimiters[0], $ready);
    }

    public static function setting(string $key, $default = null)
    {
        $setting = Setting::query()->first();

        return $setting->getAttribute($key) ?? $default;
    }

    public static function appIsDemo(): bool
    {
        return config('app.status') == 'Demo';
    }

    public static function appIsNotDemo(): bool
    {
        return config('app.status') != 'Demo';
    }
}
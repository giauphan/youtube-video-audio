<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SettingGoogle extends Settings
{

    public ?string $gtag_id;

    public bool $gtag_enabled;

    public ?string $analytic_id;

    public bool $analytic_enabled;

    public ?string $googleAds_id;

    public bool $googleAds_enabled;


    public static function group(): string
    {
        return 'google';
    }
}

<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class APiVideo extends Settings
{
    public string $url;

    public ?array $token;

    public string $username;

    public string $password;

    public string $client_id;

    public string $client_secret;

    public static function group(): string
    {
        return 'video';
    }
}

<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SettingBotBlog extends Settings
{

    public string $bot_name;

    public string $post_url;

    public string $category_post;

    public string $lang;

    public int $limit_blog;

    public static function group(): string
    {
        return 'botblog';
    }
}
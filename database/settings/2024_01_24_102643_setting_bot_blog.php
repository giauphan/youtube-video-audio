<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('botblog.bot_name', config('app.name'));
        $this->migrator->add('botblog.post_url', null);
        $this->migrator->add('botblog.lang', null);
        $this->migrator->add('botblog.category_post', null);
        $this->migrator->add('botblog.limit_blog', null);
    }
};

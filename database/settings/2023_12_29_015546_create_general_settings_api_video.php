<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('video.url', 'https:///example.com');
        $this->migrator->add('video.client_id', 'client_id');
        $this->migrator->add('video.client_secret', 'client_secret');
        $this->migrator->add('video.token', ['abc' => null]);
        $this->migrator->add('video.username', 'username');
        $this->migrator->add('video.password', 'password');
    }
};

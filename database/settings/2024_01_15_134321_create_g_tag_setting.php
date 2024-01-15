<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('google.gtag_id', null);
        $this->migrator->add('google.gtag_enabled', false);
        $this->migrator->add('google.analytic_id', null);
        $this->migrator->add('google.analytic_enabled', false);
        $this->migrator->add('google.googleAds_id', null);
        $this->migrator->add('google.googleAds_enabled', false);
    }
};

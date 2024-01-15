<?php

namespace App\Providers;

use App\Exceptions\CustomHandler;
use App\Exceptions\ThrottleHandler;
use App\Settings\SettingGoogle;
use Illuminate\Contracts\Debug\ExceptionHandler as ExceptionHandlerContract;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ExceptionHandlerContract::class, CustomHandler::class);
        $this->app->bind(ExceptionHandlerContract::class, ThrottleHandler::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $setting = new SettingGoogle();

        View::share("Setting" ,$setting);
    }
}

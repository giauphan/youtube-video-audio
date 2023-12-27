<?php

namespace App\Providers;

use App\Exceptions\CustomHandler;
use Illuminate\Contracts\Debug\ExceptionHandler as ExceptionHandlerContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ExceptionHandlerContract::class, CustomHandler::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

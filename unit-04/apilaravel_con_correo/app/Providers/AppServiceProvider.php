<?php

namespace App\Providers;

use App\Domain\Ports\Primary\IUserService;
use App\Http\Controllers\UserService;
use App\Services\LibreOfficeService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->singleton(LibreOfficeService::class,
        function ($app) {
            return new LibreOfficeService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

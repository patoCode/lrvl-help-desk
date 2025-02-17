<?php

namespace App\Providers;

use App\Services\ConfigSystemService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ConfigSystemService::class, function ($app) {
            return new ConfigSystemService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        DB::enableQueryLog();
    }
}

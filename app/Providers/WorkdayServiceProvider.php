<?php

namespace App\Providers;

use App\Services\WorkdayService;
use Illuminate\Support\ServiceProvider;

class WorkdayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(WorkdayService::class, function($app) {
            return new WorkdayService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

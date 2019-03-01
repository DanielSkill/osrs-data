<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Contracts\Repositories\PlayerRepositoryInterface',
            'App\Repositories\PlayerRepository'
        );

        $this->app->bind(
            'App\Contracts\Repositories\PlayerMetricsRepositoryInterface',
            'App\Repositories\PlayerMetricsRepository'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // 
    }
}

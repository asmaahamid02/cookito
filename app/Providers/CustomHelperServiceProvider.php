<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CustomHelperServiceProvider extends ServiceProvider
{
    protected $helpers = [
        'DateHelper',
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        // foreach ($this->helpers as $helper) {
        //     require_once app_path("Helpers/{$helper}.php");
        // }

        $this->app->singleton('DateHelper', function () {
            return require_once app_path('Helpers/DateHelper.php');
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

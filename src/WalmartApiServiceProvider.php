<?php

namespace EolabsIo\WalmartApi;

use Illuminate\Support\ServiceProvider;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Items;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\GetTaxonomy;
use EolabsIo\WalmartApi\Domain\Marketplace\Auth\Auth as WalmartapiAuth;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Providers\EventServiceProvider as ItemsEventServiceProvider;

class WalmartApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('walmart-api.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->register(ItemsEventServiceProvider::class);

        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'walmart-api');

        // Register the main class to use with the facade
        $this->app->singleton('walmartapi-auth', function () {
            return new WalmartapiAuth;
        });

        $this->app->singleton('walmartapi-get-taxonomy', function () {
            return new GetTaxonomy;
        });

        $this->app->singleton('walmartapi-items', function () {
            return new Items;
        });
    }
}

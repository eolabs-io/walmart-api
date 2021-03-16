<?php

namespace EolabsIo\WalmartApi;

use Illuminate\Support\ServiceProvider;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Items;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Orders;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\GetTaxonomy;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Returns;
use EolabsIo\WalmartApi\Domain\Marketplace\Auth\Auth as WalmartapiAuth;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Providers\EventServiceProvider as ReturnRefundEventServiceProvider;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Providers\EventServiceProvider as ItemsEventServiceProvider;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Providers\EventServiceProvider as OrdersEventServiceProvider;

class WalmartApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            if (Walmart::$runsMigrations) {
                $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
            }

            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'walmart-migrations');

            $this->publishes([
                __DIR__.'/../config/walmart.php' => config_path('walmart.php'),
            ], 'walmart-config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->register(ItemsEventServiceProvider::class);
        $this->app->register(OrdersEventServiceProvider::class);
        $this->app->register(ReturnRefundEventServiceProvider::class);

        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/walmart.php', 'walmart');

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

        $this->app->singleton('walmartapi-orders', function () {
            return new Orders;
        });

        $this->app->singleton('walmartapi-returns', function () {
            return new Returns;
        });
    }
}

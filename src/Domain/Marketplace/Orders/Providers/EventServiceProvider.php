<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Providers;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Events\FetchOrders;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Command\OrdersCommand;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Listeners\FetchOrdersListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        FetchOrders::class => [
            FetchOrdersListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // Registering package commands.
        $this->commands([
            OrdersCommand::class,
        ]);
    }
}

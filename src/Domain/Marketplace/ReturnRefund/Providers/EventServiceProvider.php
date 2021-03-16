<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Providers;

use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Events\FetchReturns;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Command\ReturnsCommand;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Listeners\FetchReturnsListener;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        FetchReturns::class => [
            FetchReturnsListener::class,
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
            ReturnsCommand::class,
        ]);
    }
}

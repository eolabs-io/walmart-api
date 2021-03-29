<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Inventory\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        // FetchInventory::class => [
        //     FetchInventoryListener::class,
        // ],
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
            // InventoryCommand::class,
        ]);
    }
}

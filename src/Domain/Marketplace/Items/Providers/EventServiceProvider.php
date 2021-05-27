<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Providers;

use EolabsIo\WalmartApi\Domain\Marketplace\Items\Events\FetchItems;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Command\ItemsCommand;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Events\FetchItemSearch;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Command\TaxonomyCommand;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Events\FetchGetTaxonomy;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Command\ItemSearchCommand;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Listeners\FetchItemsListener;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Listeners\FetchItemSearchListener;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Listeners\FetchGetTaxonomyListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        FetchGetTaxonomy::class => [
            FetchGetTaxonomyListener::class,
        ],
        FetchItems::class => [
            FetchItemsListener::class,
        ],
        FetchItemSearch::class => [
            FetchItemSearchListener::class,
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
            TaxonomyCommand::class,
            ItemsCommand::class,
            ItemSearchCommand::class,
        ]);
    }
}

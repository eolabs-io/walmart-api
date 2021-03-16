<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Listeners;

use EolabsIo\WalmartApi\Domain\Marketplace\Items\Events\FetchItems;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Jobs\PerformFetchItems;

class FetchItemsListener
{
    public function handle(FetchItems $event)
    {
        $items = $event->items;
        PerformFetchItems::dispatch($items)->onQueue('wm-items');
    }
}

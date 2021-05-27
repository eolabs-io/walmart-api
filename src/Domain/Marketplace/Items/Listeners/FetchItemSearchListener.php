<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Listeners;

use EolabsIo\WalmartApi\Domain\Marketplace\Items\Events\FetchItemSearch;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Jobs\PerformFetchItemSearch;

class FetchItemSearchListener
{
    public function handle(FetchItemSearch $event)
    {
        $items = $event->items;
        PerformFetchItemSearch::dispatch($items)->onQueue('wm-items');
    }
}

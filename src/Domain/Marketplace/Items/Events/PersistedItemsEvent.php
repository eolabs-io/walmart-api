<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Item;

class PersistedItemsEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Item */
    public $items;

    public function __construct(Item $items)
    {
        $this->items = $items;
    }
}

<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Items;

class FetchItemSearch
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\WalmartApi\Domain\Marketplace\Items\Items*/
    public $items;

    public function __construct(Items $items)
    {
        $this->items = $items;
    }
}

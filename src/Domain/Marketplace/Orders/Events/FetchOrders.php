<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Events;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Orders;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class FetchOrders
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\WalmartApi\Domain\Marketplace\Orders\Orders */
    public $orders;

    public function __construct(Orders $orders)
    {
        $this->orders = $orders;
    }
}

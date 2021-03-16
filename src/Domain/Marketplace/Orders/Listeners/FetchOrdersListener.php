<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Listeners;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Events\FetchOrders;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Jobs\PerformFetchOrders;

class FetchOrdersListener
{
    public function handle(FetchOrders $event)
    {
        $orders = $event->orders;
        PerformFetchOrders::dispatch($orders)->onQueue('wm-orders');
    }
}

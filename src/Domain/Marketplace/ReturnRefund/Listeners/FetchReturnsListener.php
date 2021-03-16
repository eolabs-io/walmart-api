<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Listeners;

use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Events\FetchReturns;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Jobs\PerformFetchReturns;

class FetchReturnsListener
{
    public function handle(FetchReturns $event)
    {
        $returns = $event->returns;
        PerformFetchReturns::dispatch($returns)->onQueue('wm-returns');
    }
}

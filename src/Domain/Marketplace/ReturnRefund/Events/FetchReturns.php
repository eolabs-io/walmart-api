<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Returns;

class FetchReturns
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Returns */
    public $returns;

    public function __construct(Returns $returns)
    {
        $this->returns = $returns;
    }
}

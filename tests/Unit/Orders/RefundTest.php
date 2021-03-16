<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Orders;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Refund;

class RefundTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Refund::class;
    }
}

<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Orders;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\RefundCharge;

class RefundChargeTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return RefundCharge::class;
    }
}

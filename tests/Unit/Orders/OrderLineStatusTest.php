<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Orders;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderLineStatus;

class OrderLineStatusTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return OrderLineStatus::class;
    }
}

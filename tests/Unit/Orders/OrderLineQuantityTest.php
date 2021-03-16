<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Orders;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderLineQuantity;

class OrderLineQuantityTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return OrderLineQuantity::class;
    }
}

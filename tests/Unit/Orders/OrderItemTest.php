<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Orders;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderItem;

class OrderItemTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return OrderItem::class;
    }
}

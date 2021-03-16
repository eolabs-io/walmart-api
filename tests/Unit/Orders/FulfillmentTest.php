<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Orders;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Fulfillment;

class FulfillmentTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Fulfillment::class;
    }
}

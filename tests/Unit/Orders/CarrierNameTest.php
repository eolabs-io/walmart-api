<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Orders;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\CarrierName;

class CarrierNameTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return CarrierName::class;
    }
}

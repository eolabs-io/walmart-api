<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Orders;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\StatusQuantity;

class StatusQuantityTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return StatusQuantity::class;
    }
}

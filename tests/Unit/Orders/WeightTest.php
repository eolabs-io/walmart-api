<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Orders;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Weight;

class WeightTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Weight::class;
    }
}

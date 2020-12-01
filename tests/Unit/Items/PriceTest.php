<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Items;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Price;

class PriceTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Price::class;
    }
}

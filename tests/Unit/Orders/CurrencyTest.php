<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Orders;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Currency;

class CurrencyTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Currency::class;
    }
}

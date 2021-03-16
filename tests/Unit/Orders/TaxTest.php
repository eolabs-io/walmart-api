<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Orders;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Tax;

class TaxTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Tax::class;
    }
}

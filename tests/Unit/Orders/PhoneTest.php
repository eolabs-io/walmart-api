<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Orders;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Phone;

class PhoneTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Phone::class;
    }
}

<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Orders;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Name;

class NameTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Name::class;
    }
}

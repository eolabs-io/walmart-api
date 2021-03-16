<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Orders;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\PostalAddress;

class PostalAddressTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return PostalAddress::class;
    }
}

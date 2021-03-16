<?php

namespace EolabsIo\WalmartApi\Tests\Unit\ReturnRefund;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\Reference;

class ReferenceTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Reference::class;
    }
}

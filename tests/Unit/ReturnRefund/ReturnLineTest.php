<?php

namespace EolabsIo\WalmartApi\Tests\Unit\ReturnRefund;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnLine;

class ReturnLineTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ReturnLine::class;
    }
}

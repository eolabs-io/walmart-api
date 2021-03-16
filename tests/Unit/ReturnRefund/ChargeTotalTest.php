<?php

namespace EolabsIo\WalmartApi\Tests\Unit\ReturnRefund;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ChargeTotal;

class ChargeTotalTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ChargeTotal::class;
    }
}

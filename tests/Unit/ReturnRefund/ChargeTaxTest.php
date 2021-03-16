<?php

namespace EolabsIo\WalmartApi\Tests\Unit\ReturnRefund;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ChargeTax;

class ChargeTaxTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ChargeTax::class;
    }
}

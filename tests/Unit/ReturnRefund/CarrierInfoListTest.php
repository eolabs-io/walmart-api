<?php

namespace EolabsIo\WalmartApi\Tests\Unit\ReturnRefund;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\CarrierInfoList;

class CarrierInfoListTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return CarrierInfoList::class;
    }
}

<?php

namespace EolabsIo\WalmartApi\Tests\Unit\ReturnRefund;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnOrderLineItem;

class ReturnOrderLineItemTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ReturnOrderLineItem::class;
    }
}

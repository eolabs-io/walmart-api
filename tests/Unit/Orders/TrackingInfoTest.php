<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Orders;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\TrackingInfo;

class TrackingInfoTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return TrackingInfo::class;
    }
}

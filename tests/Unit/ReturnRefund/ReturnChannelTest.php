<?php

namespace EolabsIo\WalmartApi\Tests\Unit\ReturnRefund;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnChannel;

class ReturnChannelTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ReturnChannel::class;
    }
}

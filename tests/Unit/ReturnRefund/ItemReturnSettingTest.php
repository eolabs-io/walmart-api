<?php

namespace EolabsIo\WalmartApi\Tests\Unit\ReturnRefund;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ItemReturnSetting;

class ItemReturnSettingTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ItemReturnSetting::class;
    }
}

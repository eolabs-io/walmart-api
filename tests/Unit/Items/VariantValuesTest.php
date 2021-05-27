<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Items;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\VariantValue;

class VariantValuesTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return VariantValue::class;
    }
}

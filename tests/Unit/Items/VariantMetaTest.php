<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Items;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\VariantMeta;

class VariantMetaTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return VariantMeta::class;
    }
}

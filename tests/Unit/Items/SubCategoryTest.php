<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Items;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\SubCategory;

class SubCategoryTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return SubCategory::class;
    }
}

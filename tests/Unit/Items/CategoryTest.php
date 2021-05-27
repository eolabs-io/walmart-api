<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Items;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Category;

class CategoryTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Category::class;
    }
}

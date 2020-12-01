<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Items;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Item;

class ItemTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Item::class;
    }
}

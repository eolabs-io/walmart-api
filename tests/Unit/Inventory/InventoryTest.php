<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Items;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Inventory\Models\Inventory;

class InventoryTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Inventory::class;
    }
}

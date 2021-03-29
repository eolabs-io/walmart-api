<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Items;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Inventory\Models\InventoryQuantity;

class InventoryQuantityTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return InventoryQuantity::class;
    }
}

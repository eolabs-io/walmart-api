<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Orders;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\ShipNode;

class ShipNodeTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ShipNode::class;
    }
}

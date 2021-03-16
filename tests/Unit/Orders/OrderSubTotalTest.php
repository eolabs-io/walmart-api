<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Orders;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderSubTotal;

class OrderSubTotalTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return OrderSubTotal::class;
    }

    /** @test */
    public function it_has_total_amount_relationship()
    {
        OrderSubTotal::factory()->hasTotalAmount()->create();

        $this->assertEquals(1, OrderSubTotal::first()->totalAmount()->count());
    }
}

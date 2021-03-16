<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Orders;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderSummary;

class OrderSummaryTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return OrderSummary::class;
    }

    /** @test */
    public function it_has_total_amount_relationship()
    {
        OrderSummary::factory()->hasTotalAmount()->create();

        $this->assertDatabaseCount('currencies', 1);
        $this->assertEquals(1, OrderSummary::first()->totalAmount()->count());
    }

    /** @test */
    public function it_has_order_sub_total_relationship()
    {
        OrderSummary::factory()->hasOrderSubTotals(3)->create();

        $this->assertDatabaseCount('order_sub_totals', 3);
        $this->assertEquals(3, OrderSummary::first()->orderSubTotals()->count());
    }
}

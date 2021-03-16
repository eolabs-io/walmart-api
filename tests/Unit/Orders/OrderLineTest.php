<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Orders;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderLine;

class OrderLineTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return OrderLine::class;
    }

    /** @test */
    public function it_has_item_relationship()
    {
        OrderLine::factory()->hasItem()->create();

        $this->assertDatabaseCount('order_items', 1);
        $this->assertEquals(1, OrderLine::first()->item()->count());
    }

    /** @test */
    public function it_has_charges_relationship()
    {
        OrderLine::factory()->hasCharges(3)->create();

        $this->assertDatabaseCount('charges', 3);
        $this->assertEquals(3, OrderLine::first()->charges()->count());
    }



    /** @test */
    public function it_has_order_line_statuses_relationship()
    {
        OrderLine::factory()->hasOrderLineStatuses(3)->create();

        $this->assertDatabaseCount('order_line_statuses', 3);
        $this->assertEquals(3, OrderLine::first()->orderLineStatuses()->count());
    }

    /** @test */
    public function it_has_refund_relationship()
    {
        OrderLine::factory()->hasRefund()->create();

        $this->assertDatabaseCount('refunds', 1);
        $this->assertEquals(1, OrderLine::first()->refund()->count());
    }


    /** @test */
    public function it_has_fulfillment_relationship()
    {
        OrderLine::factory()->hasFulfillment()->create();

        $this->assertDatabaseCount('fulfillments', 1);
        $this->assertEquals(1, OrderLine::first()->fulfillment()->count());
    }

    /** @test */
    public function it_has_order_line_quantity_relationship()
    {
        OrderLine::factory()->hasOrderLineQuantity()->create();

        $this->assertDatabaseCount('order_line_quantities', 1);
        $this->assertEquals(1, OrderLine::first()->orderLineQuantity()->count());
    }
}

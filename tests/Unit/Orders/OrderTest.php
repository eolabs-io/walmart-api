<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Orders;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Order;

class OrderTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Order::class;
    }

    /** @test */
    public function it_has_shipping_info_relationship()
    {
        Order::factory()->hasShippingInfo()->create();

        $this->assertDatabaseCount('shipping_infos', 1);
        $this->assertEquals(1, Order::first()->shippingInfo()->count());
    }

    /** @test */
    public function it_has_order_line_relationship()
    {
        Order::factory()->hasOrderLines(3)->create();

        $this->assertDatabaseCount('order_lines', 3);
        $this->assertEquals(3, Order::first()->orderLines()->count());
    }

    /** @test */
    public function it_has_order_summary_relationship()
    {
        Order::factory()->hasOrderSummary()->create();

        $this->assertDatabaseCount('order_summaries', 1);
        $this->assertEquals(1, Order::first()->orderSummary()->count());
    }

    /** @test */
    public function it_has_pickup_person_relationship()
    {
        Order::factory()->hasPickupPeople(3)->create();

        $this->assertDatabaseCount('pickup_people', 3);
        $this->assertEquals(3, Order::first()->pickupPeople()->count());
    }

    /** @test */
    public function it_has_ship_node_relationship()
    {
        Order::factory()->hasShipNode()->create();

        $this->assertDatabaseCount('ship_nodes', 1);
        $this->assertEquals(1, Order::first()->shipNode()->count());
    }
}

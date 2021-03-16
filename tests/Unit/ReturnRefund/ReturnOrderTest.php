<?php

namespace EolabsIo\WalmartApi\Tests\Unit\ReturnRefund;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Name;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Currency;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnOrder;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnChannel;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnLineGroup;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnOrderLine;

class ReturnOrderTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ReturnOrder::class;
    }

    /** @test */
    public function it_has_customer_name_relationship()
    {
        $returnName = Name::factory()->create();
        $returnOrder = ReturnOrder::factory()->create(['customer_name_id' => $returnName->id]);

        $customerName = ReturnOrder::with('customerName')->first()->customerName;

        $this->assertArraysEqual($returnName->toArray(), $customerName->toArray());
    }

    /** @test */
    public function it_has_total_refund_amount_relationship()
    {
        $returnTotalRefundAmount = Currency::factory()->create();
        $returnOrder = ReturnOrder::factory()->create(['total_refund_amount_id' => $returnTotalRefundAmount->id]);

        $totalRefundAmount = ReturnOrder::with('totalRefundAmount')->first()->totalRefundAmount;

        $this->assertArraysEqual($totalRefundAmount->toArray(), $totalRefundAmount->toArray());
    }

    /** @test */
    public function it_has_return_line_groups_relationship()
    {
        $returnOrder = ReturnOrder::factory()->create();
        $rReturnLineGroups = ReturnLineGroup::factory()->count(4)->create(['return_order_id' => $returnOrder->id]);
        $returnLineGroups = ReturnOrder::with('returnLineGroups')->first()->returnLineGroups;

        $this->assertCount(4, $rReturnLineGroups);
        $this->assertArraysEqual($rReturnLineGroups->toArray(), $returnLineGroups->toArray());
    }

    /** @test */
    public function it_has_return_order_lines_relationship()
    {
        $returnOrder = ReturnOrder::factory()->create();
        $rReturnOrderLines = ReturnOrderLine::factory()->count(4)->create(['return_order_id' => $returnOrder->id]);
        $returnOrderLines = ReturnOrder::with('returnOrderLines')->first()->returnOrderLines;

        $this->assertCount(4, $rReturnOrderLines);
        $this->assertArraysEqual($rReturnOrderLines->toArray(), $returnOrderLines->toArray());
    }

    /** @test */
    public function it_has_return_channel_relationship()
    {
        $returnReturnChannel = ReturnChannel::factory()->create();
        $returnOrder = ReturnOrder::factory()->create(['return_channel_id' => $returnReturnChannel->id]);

        $returnChannel = ReturnOrder::with('returnChannel')->first()->returnChannel;

        $this->assertArraysEqual($returnChannel->toArray(), $returnReturnChannel->toArray());
    }
}

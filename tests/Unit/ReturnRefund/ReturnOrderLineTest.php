<?php

namespace EolabsIo\WalmartApi\Tests\Unit\ReturnRefund;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Currency;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\Quantity;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ChargeTotal;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\OrderLineCharge;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnOrderLine;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ItemReturnSetting;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnOrderLineItem;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnTrackingDetail;

class ReturnOrderLineTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ReturnOrderLine::class;
    }

    // Relationships

    /** @test */
    public function it_has_item_relationship()
    {
        $returnOrderLineItem = ReturnOrderLineItem::factory()->create();
        $returnOrderLine = ReturnOrderLine::factory()->create(['item_id' => $returnOrderLineItem->id]);

        $item = ReturnOrderLine::with('item')->first()->item;

        $this->assertArraysEqual($returnOrderLineItem->toArray(), $item->toArray());
    }

    /** @test */
    public function it_has_charges_relationship()
    {
        $returnCharges = OrderLineCharge::factory()->count(4)->create();
        $returnOrderLine = ReturnOrderLine::factory()->create();

        $returnOrderLine->charges()->attach($returnCharges);

        $charges = ReturnOrderLine::with('charges')->first()->charges;

        $this->assertCount(4, $charges);
        $this->assertArraysEqual($returnCharges->toArray(), $charges->toArray());
    }

    /** @test */
    public function it_has_unit_price_relationship()
    {
        $returnUnitPrice = Currency::factory()->create();
        $returnOrderLine = ReturnOrderLine::factory()->create(['unit_price_id' => $returnUnitPrice->id]);

        $unitPrice = ReturnOrderLine::with('unitPrice')->first()->unitPrice;

        $this->assertArraysEqual($returnUnitPrice->toArray(), $unitPrice->toArray());
    }

    /** @test */
    public function it_has_item_return_settings_relationship()
    {
        $returnItemReturnSettings = ItemReturnSetting::factory()->count(4)->create();
        $returnOrderLine = ReturnOrderLine::factory()->create();

        $returnOrderLine->itemReturnSettings()->attach($returnItemReturnSettings);

        $itemReturnSettings = ReturnOrderLine::with('itemReturnSettings')->first()->itemReturnSettings;

        $this->assertCount(4, $itemReturnSettings);
        $this->assertArraysEqual($returnItemReturnSettings->toArray(), $itemReturnSettings->toArray());
    }

    /** @test */
    public function it_has_charge_totals_relationship()
    {
        $returnChargeTotals = ChargeTotal::factory()->count(4)->create();
        $returnOrderLine = ReturnOrderLine::factory()->create();

        $returnOrderLine->chargeTotals()->attach($returnChargeTotals);

        $chargeTotals = ReturnOrderLine::with('chargeTotals')->first()->chargeTotals;

        $this->assertCount(4, $returnChargeTotals);
        $this->assertArraysEqual($returnChargeTotals->toArray(), $chargeTotals->toArray());
    }

    /** @test */
    public function it_has_quantity_relationship()
    {
        $returnQuantity = Quantity::factory()->create();
        $returnOrderLine = ReturnOrderLine::factory()->create(['quantity_id' => $returnQuantity->id]);

        $quantity = ReturnOrderLine::with('quantity')->first()->quantity;

        $this->assertArraysEqual($returnQuantity->toArray(), $quantity->toArray());
    }

    /** @test */
    public function it_has_return_tracking_details_relationship()
    {
        $rReturnChargeTotals = ReturnTrackingDetail::factory()->count(4)->create();
        $returnOrderLine = ReturnOrderLine::factory()->create();

        $returnOrderLine->returnTrackingDetails()->attach($rReturnChargeTotals);

        $returnTrackingDetails = ReturnOrderLine::with('returnTrackingDetails')->first()->returnTrackingDetails;

        $this->assertCount(4, $returnTrackingDetails);
        $this->assertArraysEqual($rReturnChargeTotals->toArray(), $returnTrackingDetails->toArray());
    }
}

<?php

namespace EolabsIo\WalmartApi\Tests\Unit\ReturnRefund;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ChargeTax;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\Reference;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\OrderLineCharge;

class OrderLineChargeTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return OrderLineCharge::class;
    }

    /** @test */
    public function it_has_charge_tax_relationship()
    {
        $orderLineCharge = OrderLineCharge::factory()->create();
        $chargeTaxes = ChargeTax::factory()
            ->times(4)
            ->create([
                'order_line_charge_id' => $orderLineCharge->id
            ]);

        $taxes = OrderLineCharge::with('taxes')->first()->taxes;

        $this->assertEquals($chargeTaxes->toArray(), $taxes->toArray());
    }

    /** @test */
    public function it_has_reference_relationship()
    {
        $chargeReferences = Reference::factory()->count(4)->create();
        $orderLineCharge = OrderLineCharge::factory()->create();

        $orderLineCharge->references()->attach($chargeReferences);

        $references = OrderLineCharge::with('references')->first()->references;

        $this->assertCount(4, $references);
        $this->assertArraysEqual($chargeReferences->toArray(), $references->toArray());
    }
}

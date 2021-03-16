<?php

namespace EolabsIo\WalmartApi\Tests\Unit\ReturnRefund;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\Label;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\CarrierInfoList;

class LabelTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Label::class;
    }

    //
    /** @test */
    public function it_has_carrier_info_list_relationship()
    {
        $returnCarrierInfoLists = CarrierInfoList::factory()->count(4)->create();
        $label = Label::factory()->create();

        $label->carrierInfoLists()->attach($returnCarrierInfoLists);

        $carrierInfoLists = Label::with('carrierInfoLists')->first()->carrierInfoLists;

        $this->assertCount(4, $carrierInfoLists);
        $this->assertArraysEqual($returnCarrierInfoLists->toArray(), $carrierInfoLists->toArray());
    }
}

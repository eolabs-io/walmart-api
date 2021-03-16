<?php

namespace EolabsIo\WalmartApi\Tests\Unit\ReturnRefund;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\Reference;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnTrackingDetail;

class ReturnTrackingDetailTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ReturnTrackingDetail::class;
    }

    /** @test */
    public function it_has_reference_relationship()
    {
        $returnReferences = Reference::factory()->count(4)->create();
        $returnTrackingDetail = ReturnTrackingDetail::factory()->create();

        $returnTrackingDetail->references()->attach($returnReferences);

        $references = ReturnTrackingDetail::with('references')->first()->references;

        $this->assertCount(4, $references);
        $this->assertArraysEqual($returnReferences->toArray(), $references->toArray());
    }
}

<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Orders;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\ShippingInfo;

class ShippingInfoTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ShippingInfo::class;
    }

    /** @test */
    public function it_has_postal_address_relationship()
    {
        ShippingInfo::factory()->hasPostalAddress()->create();

        $this->assertDatabaseCount('postal_addresses', 1);
        $this->assertEquals(1, ShippingInfo::first()->postalAddress()->count());
    }
}

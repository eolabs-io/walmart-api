<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Orders;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\PickupPerson;

class PickupPersonTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return PickupPerson::class;
    }

    /** @test */
    public function it_has_name_relationship()
    {
        PickupPerson::factory()->hasName()->create();

        $this->assertDatabaseCount('names', 1);
        $this->assertEquals(1, PickupPerson::first()->name()->count());
    }

    /** @test */
    public function it_has_phone_relationship()
    {
        PickupPerson::factory()->hasPhone()->create();

        $this->assertDatabaseCount('phones', 1);
        $this->assertEquals(1, PickupPerson::first()->phone()->count());
    }
}

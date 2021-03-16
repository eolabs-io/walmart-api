<?php

namespace EolabsIo\WalmartApi\Tests\Feature\Orders;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\WalmartApi\Tests\TestCase;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Events\FetchOrders;

class OrdersCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
        Event::fake();
    }

    /** @test */
    public function it_can_execute_taxonomy_artisan_command()
    {
        $this->artisan('walmartApi:orders')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchOrders::class, function ($event) {
            return true;
        });
    }
}

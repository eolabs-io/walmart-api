<?php

namespace EolabsIo\WalmartApi\Tests\Feature\Items;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\WalmartApi\Tests\TestCase;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Events\FetchItemSearch;

class ItemSearchCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
        Event::fake();
    }

    /** @test */
    public function it_can_execute_item_search_artisan_command()
    {
        $this->artisan('walmartApi:item-search')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchItemSearch::class, function ($event) {
            return true;
        });
    }
}

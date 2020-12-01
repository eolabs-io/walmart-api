<?php

namespace EolabsIo\WalmartApi\Tests\Feature\Items;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\WalmartApi\Tests\TestCase;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Events\FetchGetTaxonomy;

class TaxonomyCommandTest extends TestCase
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
        $this->artisan('walmartApi:get-taxonomy')
             ->assertExitCode(0);

        // Assert that event is called
        Event::assertDispatched(FetchGetTaxonomy::class, function ($event) {
            return true;
        });
    }
}

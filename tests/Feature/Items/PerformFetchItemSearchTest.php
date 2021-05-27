<?php

namespace EolabsIo\WalmartApi\Tests\Feature\Items;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\WalmartApi\Tests\TestCase;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Items;
use EolabsIo\WalmartApi\Tests\Factories\ItemsRequestFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Events\FetchItemSearch;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Jobs\PerformFetchItemSearch;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Jobs\ProcessItemSearchResponse;

class PerformFetchItemSearchTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Queue::fake();
        Event::fake();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /** @test */
    public function it_calls_the_correct_job()
    {
        ItemsRequestFactory::new()->fakeSearchResponse();

        PerformFetchItemSearch::dispatch(new Items);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchItemSearch::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessItemSearchResponse::class, function ($job) {
            return data_get($job->results, 'items.0.itemId') === '393016031';
        });

        // Assert that was not called for NextToken
        Event::assertNotDispatched(FetchItemSearch::class);
    }
}

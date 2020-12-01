<?php

namespace EolabsIo\WalmartApi\Tests\Feature\Items;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\WalmartApi\Tests\TestCase;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Items;
use EolabsIo\WalmartApi\Tests\Factories\ItemsRequestFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Events\FetchItems;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Jobs\PerformFetchItems;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Jobs\ProcessItemsResponse;

class PerformFetchItemsTest extends TestCase
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
    public function it_calls_the_correct_job_with_next_cursor()
    {
        ItemsRequestFactory::new()->fakeItemsResponse();

        PerformFetchItems::dispatch(new Items);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchItems::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessItemsResponse::class, function ($job) {
            return data_get($job->results, 'ItemResponse.0.sku') === '2792005';
        });

        // Assert that was not called for NextToken
        Event::assertDispatched(FetchItems::class);
    }

    /** @test */
    public function it_calls_the_correct_job_without_next_cursor()
    {
        ItemsRequestFactory::new()->fakeItemsWithoutNextCursorResponse();

        PerformFetchItems::dispatch(new Items);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchItems::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessItemsResponse::class, function ($job) {
            return data_get($job->results, 'ItemResponse.0.sku') === '2792005';
        });

        // Assert that was not called for NextToken
        Event::assertNotDispatched(FetchItems::class);
    }
}

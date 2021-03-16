<?php

namespace EolabsIo\WalmartApi\Tests\Feature\Orders;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\WalmartApi\Tests\TestCase;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Orders;
use EolabsIo\WalmartApi\Tests\Factories\OrdersRequestFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Events\FetchOrders;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Jobs\PerformFetchOrders;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Jobs\ProcessOrdersResponse;

class PerformFetchOrdersTest extends TestCase
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
        OrdersRequestFactory::new()->fakeOrdersResponse();

        PerformFetchOrders::dispatch(new Orders);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchOrders::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessOrdersResponse::class, function ($job) {
            return data_get($job->results, 'list.elements.order.0.purchaseOrderId') === '1796277083022';
        });

        // Assert that was called for NextCursor
        Event::assertDispatched(FetchOrders::class);
    }

    /** @test */
    public function it_calls_the_correct_job_without_next_cursor()
    {
        OrdersRequestFactory::new()->fakeOrdersWithoutNextCursorResponse();

        PerformFetchOrders::dispatch(new Orders);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchOrders::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessOrdersResponse::class, function ($job) {
            return data_get($job->results, 'list.elements.order.0.purchaseOrderId') === '3906277083742';
        });

        // Assert that was not called for NextToken
        Event::assertNotDispatched(FetchOrders::class);
    }
}

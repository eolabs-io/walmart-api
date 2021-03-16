<?php

namespace EolabsIo\WalmartApi\Tests\Feature\ReturnRefund;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\WalmartApi\Tests\TestCase;
use EolabsIo\WalmartApi\Tests\Factories\ReturnsRequestFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Returns;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Events\FetchReturns;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Jobs\PerformFetchReturns;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Jobs\ProcessReturnsResponse;

class PerformFetchReturnsTest extends TestCase
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
        ReturnsRequestFactory::new()->fakeReturnsResponse();

        PerformFetchReturns::dispatch(new Returns);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchReturns::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessReturnsResponse::class, function ($job) {
            return data_get($job->results, 'returnOrders.0.returnOrderId') === '103738048909818825';
        });

        // Assert that was called for NextCursor
        Event::assertDispatched(FetchReturns::class);
    }

    /** @test */
    public function it_calls_the_correct_job_without_next_cursor()
    {
        ReturnsRequestFactory::new()->fakeReturnsWithoutNextCursorResponse();

        PerformFetchReturns::dispatch(new Returns);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchReturns::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessReturnsResponse::class, function ($job) {
            return data_get($job->results, 'returnOrders.0.customerEmailId') === 'emailID123456@relay.walmart.com';
        });

        // Assert that was not called for NextToken
        Event::assertNotDispatched(FetchReturns::class);
    }
}

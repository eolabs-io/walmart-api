<?php

namespace EolabsIo\WalmartApi\Tests\Feature\Items;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use EolabsIo\WalmartApi\Tests\TestCase;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\GetTaxonomy;
use EolabsIo\WalmartApi\Tests\Factories\TaxonomyRequestFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Events\FetchGetTaxonomy;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Jobs\PerformFetchGetTaxonomy;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Jobs\ProcessGetTaxonomyResponse;

class PerformFetchGetTaxonomyTest extends TestCase
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
        TaxonomyRequestFactory::new()->fakeResponse();

        PerformFetchGetTaxonomy::dispatch(new GetTaxonomy);

        // Assert a job was pushed...
        Queue::assertPushed(PerformFetchGetTaxonomy::class, function ($job) {
            $job->handle();
            return true;
        });

        // Assert a job was pushed...
        Queue::assertPushed(ProcessGetTaxonomyResponse::class, function ($job) {
            return data_get($job->results, 'payload.0.category') === 'Animal';
        });

        // Assert that was not called for NextToken
        Event::assertNotDispatched(FetchGetTaxonomy::class);
    }
}

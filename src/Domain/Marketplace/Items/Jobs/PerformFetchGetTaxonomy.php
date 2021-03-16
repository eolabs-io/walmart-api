<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\RequestException;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\GetTaxonomy;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Jobs\ProcessGetTaxonomyResponse;

class PerformFetchGetTaxonomy implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /** @var EolabsIo\WalmartApi\Domain\Marketplace\Items\GetTaxonomy */
    public $getTaxonomy;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(GetTaxonomy $getTaxonomy)
    {
        $this->getTaxonomy = $getTaxonomy;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $results = $this->getTaxonomy->fetch();

            ProcessGetTaxonomyResponse::dispatch($results);
        } catch (RequestException $exception) {
            // $delay = 30;
            // $this->handleRequestException($exception, $delay);
        }
    }
}

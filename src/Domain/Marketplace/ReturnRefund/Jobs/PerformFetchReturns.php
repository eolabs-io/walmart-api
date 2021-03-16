<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\RequestException;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Returns;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Events\FetchReturns;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Jobs\ProcessReturnsResponse;

class PerformFetchReturns implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /** @var EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Returns */
    public $returns;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Returns $returns)
    {
        $this->returns = $returns;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $results = $this->returns->fetch();

            ProcessReturnsResponse::dispatch($results);
            FetchReturns::dispatchIf($this->returns->hasNextCursor(), $this->returns);
        } catch (RequestException $exception) {
            // $delay = 30;
            // $this->handleRequestException($exception, $delay);
        }
    }
}

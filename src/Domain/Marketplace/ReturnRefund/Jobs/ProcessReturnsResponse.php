<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions\PersistReturnsAction;

class ProcessReturnsResponse implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var Illuminate\Support\Collection */
    public $results;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Collection $results)
    {
        $this->results = $results;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        (new PersistReturnsAction($this->results))->execute();
    }
}

<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\RequestException;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Items;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Events\FetchItems;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Jobs\ProcessItemsResponse;

class PerformFetchItems implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /** @var EolabsIo\WalmartApi\Domain\Marketplace\Items\Items */
    public $items;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Items $items)
    {
        $this->items = $items;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $results = $this->items->fetch();

            ProcessItemsResponse::dispatch($results);
            FetchItems::dispatchIf($this->items->hasNextCursor(), $this->items);
        } catch (RequestException $exception) {
            // $delay = 30;
            // $this->handleRequestException($exception, $delay);
        }
    }
}

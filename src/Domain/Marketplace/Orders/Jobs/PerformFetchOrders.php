<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\RequestException;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Orders;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Events\FetchOrders;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Jobs\ProcessOrdersResponse;

class PerformFetchOrders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /** @var olabsIo\WalmartApi\Domain\Marketplace\Orders\Orders */
    public $orders;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Orders $orders)
    {
        $this->orders = $orders;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $results = $this->orders->fetch();

            ProcessOrdersResponse::dispatch($results);
            FetchOrders::dispatchIf($this->orders->hasNextCursor(), $this->orders);
        } catch (RequestException $exception) {
            // $delay = 30;
            // $this->handleRequestException($exception, $delay);
        }
    }
}

<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Command;

use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Returns;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Events\FetchReturns;

class ReturnsCommand extends Command
{
    protected $signature = 'walmartApi:returns
                            {--return-order-id= : Return order identifier of the return order.}
                            {--customer-order-id= : The customer order ID.}
                            {--status-initiated : Returns with initiated status.}
                            {--status-delivered : Returns with delivered status.}
                            {--status-completed : Returns with completed status.}
                            {--replacement-info : Provides additional attributes.}
                            {--return-type-replacement : Specifies if the return order is a replacement.}
                            {--return-type-refund : Specifies if the return order is a refund.}
                            {--return-creation-start-date= : Start Date for querying all return orders that were created after that date.}
                            {--return-creation-end-date= : Limits the query to the return orders that were created before this date.}
                            {--return-last-modified-start-date= : Start Date for querying all return orders that were modified after that date.}
                            {--return-last-modified-end-date= : Limits the query to the return orders that were modified before this date.}
                            {--limit= : The number of orders to be returned. Cannot be larger than 200.}';

    protected $description = 'Retrieves the details of return orders for the specified filter criteria.';


    public function handle()
    {
        $this->info('Getting Return Orders from Walmart.com...');

        $returns = new Returns;

        $returns = $this->applyOptions($returns);

        FetchReturns::dispatch($returns);
    }

    public function applyOptions(Returns $returns): Returns
    {
        // Apply options
        if ($returnOrderId = $this->option('return-order-id')) {
            $returns->withReturnOrderId($returnOrderId);
        }

        if ($customerOrderId = $this->option('customer-order-id')) {
            $returns->withCustomerOrderId($customerOrderId);
        }

        if ($this->option('status-initiated')) {
            $returns->withStatusInitiated();
        }

        if ($this->option('status-delivered')) {
            $returns->withStatusDelivered();
        }

        if ($this->option('status-completed')) {
            $returns->withStatusCompleted();
        }

        if ($this->option('replacement-info')) {
            $returns->withReplacementInfo();
        }

        if ($this->option('return-type-replacement')) {
            $returns->withReturnTypeReplacement();
        }

        if ($this->option('return-type-refund')) {
            $returns->withReturnTypeRefund();
        }

        if ($returnCreationStartDate = $this->option('return-creation-start-date')) {
            $returns->withReturnCreationStartDate(Carbon::create($returnCreationStartDate));
        }

        if ($returnCreationEndDate = $this->option('return-creation-end-date')) {
            $returns->withReturnCreationEndDate(Carbon::create($returnCreationEndDate));
        }

        if ($returnLastModifiedStartDate = $this->option('return-last-modified-start-date')) {
            $returns->withReturnCreationStartDate(Carbon::create($returnLastModifiedStartDate));
        }

        if ($returnLastModifiedEndSate = $this->option('return-last-modified-end-date')) {
            $returns->withReturnCreationEndDate(Carbon::create($returnLastModifiedEndSate));
        }

        if ($limit = $this->option('limit')) {
            $returns->withLimit($limit);
        }

        return $returns;
    }
}

<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Command;

use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Orders;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Events\FetchOrders;

class OrdersCommand extends Command
{
    protected $signature = 'walmartApi:orders
                            {--sku= : A seller-provided Product ID.}
                            {--customer-order-id= : The customer order ID.}
                            {--purchase-order-id= : The purchase order ID. One customer may have multiple purchase orders..}
                            {--status-created : Status created of purchase order line.}
                            {--status-acknowledged : Status acknowledged of purchase order line.}
                            {--status-shipped : Status shipped of purchase order line.}
                            {--status-cancelled : Status cancelled of purchase order line.}
                            {--created-start-date= : Fetches all purchase orders that were created after this date.}
                            {--created-end-date= : Fetches all purchase orders that were created before this date.}
                            {--from-expected-ship-date= : Fetches all purchase orders that have order lines with an expected ship date after this date.}
                            {--to-expected-ship-date= : Fetches all purchase orders that have order lines with an expected ship date before this date.}
                            {--last-modified-start-date= : Fetches all purchase orders that were modified after this date.}
                            {--last-modified-end-date= : Fetches all purchase orders that were modified before this date.}
                            {--limit= : The number of orders to be returned. Cannot be larger than 200.}
                            {--product-info : Provides the image URL and product weight in response.}
                            {--ship-node-type-seller-fulfilled : Specifies the type SellerFulfilled of shipNode.}
                            {--ship-node-type-wfs-fulfilled : Specifies the type WFSFulfilled of shipNode.}
                            {--ship-node-type-3pl-fulfilled : Specifies the type 3PLFulfilled of shipNode.}
                            {--shipping-program-type : Specifies the type of program. }';

    protected $description = 'Retrieves the details of all the orders for specified search criteria.';


    public function handle()
    {
        $this->info('Getting Orders from Walmart.com...');

        $orders = new Orders;

        $orders = $this->applyOptions($orders);

        FetchOrders::dispatch($orders);
    }

    public function applyOptions(Orders $orders): Orders
    {
        // Apply options
        if ($sku = $this->option('sku')) {
            $orders->withSku($sku);
        }

        if ($customerOrderId = $this->option('customer-order-id')) {
            $orders->withCustomerOrderId($customerOrderId);
        }

        if ($purchaseOrderId = $this->option('purchase-order-id')) {
            $orders->withPurchaseOrderId($purchaseOrderId);
        }

        if ($statusCreated = $this->option('status-created')) {
            $orders->withStatusCreated();
        }

        if ($statusAcknowledged = $this->option('status-acknowledged')) {
            $orders->withStatusAcknowledged();
        }

        if ($statusShipped = $this->option('status-shipped')) {
            $orders->withStatusShipped();
        }

        if ($statusCancelled = $this->option('status-cancelled')) {
            $orders->withStatusCancelled();
        }

        if ($createdStartDate = $this->option('created-start-date')) {
            $orders->withCreatedStartDate(Carbon::create($createdStartDate));
        }

        if ($createdEndDate = $this->option('created-end-date')) {
            $orders->withCreatedEndDate(Carbon::create($createdEndDate));
        }

        if ($fromExpectedShipDate = $this->option('from-expected-ship-date')) {
            $orders->withFromExpectedShipDate(Carbon::create($fromExpectedShipDate));
        }

        if ($toExpectedShipDate = $this->option('to-expected-ship-date')) {
            $orders->withToExpectedShipDate(Carbon::create($toExpectedShipDate));
        }

        if ($lastModifiedStartDate = $this->option('last-modified-start-date')) {
            $orders->withLastModifiedStartDate(Carbon::create($lastModifiedStartDate));
        }

        if ($lastModifiedEndDate = $this->option('last-modified-end-date')) {
            $orders->withLastModifiedEndDate(Carbon::create($lastModifiedEndDate));
        }

        if ($limit = $this->option('limit')) {
            $orders->withLimit($limit);
        }

        if ($productInfo = $this->option('product-info')) {
            $orders->withProductInfo();
        }

        if ($shipNodeTypeSellerFulfilled = $this->option('ship-node-type-seller-fulfilled')) {
            $orders->withShipNodeTypeSellerFulfilled();
        }

        if ($shipNodeTypeWFSFulfilled = $this->option('ship-node-type-wfs-fulfilled')) {
            $orders->withShipNodeTypeWFSFulfilled();
        }

        if ($shipNodeType3PLFulfilled = $this->option('ship-node-type-3pl-fulfilled')) {
            $orders->withShipNodeType3PLFulfilled();
        }

        if ($shippingProgramType = $this->option('shipping-program-type')) {
            $orders->withShippingProgramType();
        }

        return $orders;
    }
}

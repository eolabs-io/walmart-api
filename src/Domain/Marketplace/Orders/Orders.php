<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders;

use EolabsIo\WalmartApi\Domain\Marketplace\Shared\WalmartCore;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Concerns\OrdersQueryable;

class Orders extends WalmartCore
{
    use OrdersQueryable;


    public function getBranchUrl(): string
    {
        return '/v3/orders';
    }

    public function getNextCursorAccessor(): string
    {
        return 'list.meta.nextCursor';
    }

    public function fetchOne()
    {
        // An order
        $id = $this->getPurchaseOrderId();
        $endpoint = $this->getBranchUrl() . "/{$id}";
        $parameters = $this->getOrderQueryParameters();


        return $this->get($endpoint, $parameters);
    }

    public function fetch()
    {
        // Retrieves the details of all the orders for specified search criteria.
        $endpoint = $this->getBranchUrl();
        $parameters = $this->getOrdersQueryParameters();

        return $this->get($endpoint, $parameters);
    }

    public function acknowledge(string $purchaseOrderId)
    {
        $endpoint = $this->getBranchUrl() . "/{$purchaseOrderId}/acknowledge";

        return $this->post($endpoint);
    }

    public function shipOrderLines($purchaseOrderId, $parameters)
    {
        // $endpoint = $this->getBranchUrl() . '/count';
        // $parameters = $this->getItemCountParameters();

        // return $this->get($endpoint, $parameters);
    }

    public function cancelOrderLines($purchaseOrderId, $parameters)
    {
        // $endpoint = $this->getBranchUrl() . "/{$sku}";

        // return $this->delete($endpoint);
    }

    public function refundOrderLines($purchaseOrderId, $parameters)
    {
        // $endpoint = $this->getBranchUrl() . "/{$sku}";

        // return $this->delete($endpoint);
    }
}

<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund;

use EolabsIo\WalmartApi\Domain\Marketplace\Shared\WalmartCore;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Concerns\ReturnsQueryable;

class Returns extends WalmartCore
{
    use ReturnsQueryable;


    public function getBranchUrl(): string
    {
        return '/v3/returns';
    }

    public function getNextCursorAccessor(): string
    {
        return 'meta.nextCursor';
    }

    public function issueRefund()
    {
        // An order
        // $id = $this->getReturnOrderId();
        // $endpoint = $this->getBranchUrl() . "/{$id}/refund";
        // $parameters = $this->getOrderQueryParameters();


        // return $this->post($endpoint, $parameters);
    }

    public function fetch()
    {
        // Retrieves the details of return orders for the specified filter criteria.
        $endpoint = $this->getBranchUrl();
        $parameters = $this->getReturnsQueryParameters();

        return $this->get($endpoint, $parameters);
    }

    public function returnItemOverrides()
    {
        // $endpoint = "/v3/feeds";

        // return $this->post($endpoint);
    }
}

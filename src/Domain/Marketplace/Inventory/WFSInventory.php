<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Inventory;

use EolabsIo\WalmartApi\Domain\Marketplace\Shared\WalmartCore;
use EolabsIo\WalmartApi\Domain\Marketplace\Inventory\Concerns\WFSInventoryQueryable;

class WFSInventory extends WalmartCore
{
    use WFSInventoryQueryable;


    public function getBranchUrl(): string
    {
        return '/v3/fulfillment/inventory';
    }

    public function fetch()
    {
        // Retrieves the details of Inventory for the specified filter criteria.
        $endpoint = $this->getBranchUrl();
        $parameters = $this->getWFSInventoryQueryParameters();

        return $this->get($endpoint, $parameters);
    }
}

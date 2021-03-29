<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Inventory;

use EolabsIo\WalmartApi\Domain\Marketplace\Shared\WalmartCore;
use EolabsIo\WalmartApi\Domain\Marketplace\Inventory\Concerns\InventoryQueryable;

class Inventory extends WalmartCore
{
    use InventoryQueryable;


    public function getBranchUrl(): string
    {
        return '/v3/inventory';
    }

    public function fetch()
    {
        // Retrieves the details of Inventory for the specified filter criteria.
        $endpoint = $this->getBranchUrl();
        $parameters = $this->getInventoryQueryParameters();

        return $this->get($endpoint, $parameters);
    }
}

<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Inventory\Concerns;

trait InventoryQueryable
{

    /** @var array */
    private $inventoryQueryableParameters = [
        'sku' => null,
        'shipNode' => null,
    ];


    public function withSku($sku = null): self
    {
        $this->inventoryQueryableParameters['sku'] = $sku;

        return $this;
    }

    public function withShipNode($shipNode = null): self
    {
        $this->inventoryQueryableParameters['shipNode'] = $shipNode;

        return $this;
    }

    public function getInventoryQueryParameters(): array
    {
        return $this->inventoryQueryableParameters;
    }
}

<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Inventory\Concerns;

use Illuminate\Support\Carbon;

trait WFSInventoryQueryable
{

    /** @var array */
    private $wfsInventoryQueryableParameters = [
        'sku' => null,
        'fromModifiedDate' => null,
        'toModifiedDate' => null,
        'limit' => 10,
        'offset' => 0,
    ];


    public function withSku($sku = null): self
    {
        $this->wfsInventoryQueryableParameters['sku'] = $sku;

        return $this;
    }

    public function withFromModifiedDate(Carbon $date = null): self
    {
        $this->wfsInventoryQueryableParameters['fromModifiedDate'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withToModifiedDate(Carbon $date = null): self
    {
        $this->wfsInventoryQueryableParameters['toModifiedDate'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withLimit($limit = null): self
    {
        $this->wfsInventoryQueryableParameters['limit'] = $limit;

        return $this;
    }

    public function withOffset($offset = null): self
    {
        $this->wfsInventoryQueryableParameters['offset'] = $offset;

        return $this;
    }

    public function getWFSInventoryQueryParameters(): array
    {
        return $this->wfsInventoryQueryableParameters;
    }
}

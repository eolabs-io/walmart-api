<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items;

use EolabsIo\WalmartApi\Domain\Marketplace\Shared\WalmartCore;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Concerns\ItemCountable;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Concerns\ItemQueryable;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Concerns\ItemSearchable;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Concerns\ItemsQueryable;

class Items extends WalmartCore
{
    use ItemQueryable,
        ItemsQueryable,
        ItemSearchable,
        ItemCountable;

    public function getBranchUrl(): string
    {
        return '/v3/items';
    }

    public function fetch()
    {
        if ($this->hasProductId()) {
            // An item
            $id = $this->getProductId();
            $endpoint = $this->getBranchUrl() . "/{$id}";
            $parameters = $this->getItemQueryParameters();
        } else {
            // Displays a list of all items by using either nextCursor or offset and limit query parameters
            $endpoint = $this->getBranchUrl();
            $parameters = $this->getItemsQueryParameters();
        }

        return $this->get($endpoint, $parameters);
    }

    public function search()
    {
        $endpoint = $this->getBranchUrl() . '/walmart/search';
        $parameters = $this->getSearchQueryParameters();

        return $this->get($endpoint, $parameters)->merge(['query_parameters' => $parameters]);
    }

    public function count()
    {
        $endpoint = $this->getBranchUrl() . '/count';
        $parameters = $this->getItemCountParameters();

        return $this->get($endpoint, $parameters);
    }

    public function retire(string $sku)
    {
        $endpoint = $this->getBranchUrl() . "/{$sku}";

        return $this->delete($endpoint);
    }
}

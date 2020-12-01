<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Concerns;

trait ItemSearchable
{

    /** @var array */
    private $searchQueryParameters = [
        'query' => '',
        'upc' => '',
        'gtin' => '',
    ];


    public function withSearchQuery(string $query = null): self
    {
        $this->searchQueryParameters['query'] = $query;

        return $this;
    }

    public function withSearchUPC(string $upc = null): self
    {
        $this->searchQueryParameters['upc'] = $upc;

        return $this;
    }

    public function withSearchGTIN(string $gtin = null): self
    {
        $this->searchQueryParameters['gtin'] = $gtin;

        return $this;
    }

    public function getSearchQueryParameters(): array
    {
        return $this->searchQueryParameters;
    }
}

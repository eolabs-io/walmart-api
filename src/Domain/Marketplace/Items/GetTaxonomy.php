<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items;

use EolabsIo\WalmartApi\Domain\Marketplace\Shared\WalmartCore;

class GetTaxonomy extends WalmartCore
{
    public function getBranchUrl(): string
    {
        return '/v3/items/taxonomy';
    }

    public function fetch()
    {
        return $this->get();
    }
}

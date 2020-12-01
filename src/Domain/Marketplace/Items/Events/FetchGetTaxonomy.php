<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\GetTaxonomy;

class FetchGetTaxonomy
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\WalmartApi\Domain\Marketplace\Items\GetTaxonomy */
    public $getTaxonomy;

    public function __construct(GetTaxonomy $getTaxonomy)
    {
        $this->getTaxonomy = $getTaxonomy;
    }
}

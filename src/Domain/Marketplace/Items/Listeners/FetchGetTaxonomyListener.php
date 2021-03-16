<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Listeners;

use EolabsIo\WalmartApi\Domain\Marketplace\Items\Events\FetchGetTaxonomy;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Jobs\PerformFetchGetTaxonomy;

class FetchGetTaxonomyListener
{
    public function handle(FetchGetTaxonomy $event)
    {
        $getTaxonomy = $event->getTaxonomy;
        PerformFetchGetTaxonomy::dispatch($getTaxonomy)->onQueue('wm-get-taxonomy');
    }
}

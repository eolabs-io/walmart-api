<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Command;

use Illuminate\Console\Command;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\GetTaxonomy;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Events\FetchGetTaxonomy;

class TaxonomyCommand extends Command
{
    protected $signature = 'walmartApi:get-taxonomy';

    protected $description = 'Gets the category taxonomy that Walmart.com uses to categorize items.';


    public function handle()
    {
        $this->info('Getting category taxonomy from Walmart.com...');

        FetchGetTaxonomy::dispatch(new GetTaxonomy);
    }
}

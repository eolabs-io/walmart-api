<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Command;

use Illuminate\Console\Command;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Items;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Events\FetchItemSearch;

class ItemSearchCommand extends Command
{
    protected $signature = 'walmartApi:item-search
                            {--query= : Specifies a keyword search as a String.}
                            {--upc= : Specifies a Universal Product Code (UPC) search. UPC must be 12 digits.}
                            {--gtin= : Specifies a Global Trade Item Number (GTIN) search. GTIN must be 14 digits.}';

    protected $description = 'The Item Search API allows you to query the Walmart.com global product catalog by item keyword, UPC or GTIN';


    public function handle()
    {
        $this->info('Getting Item Search from Walmart.com...');

        $items = new Items;

        $items = $this->applyOptions($items);

        FetchItemSearch::dispatch($items);
    }

    public function applyOptions(Items $items): Items
    {
        // Apply options
        if ($query = $this->option('query')) {
            $items->withSearchQuery($query);
        }

        if ($upc = $this->option('upc')) {
            $items->withSearchUPC($upc);
        }

        if ($gtin = $this->option('gtin')) {
            $items->withSearchGTIN($gtin);
        }

        return $items;
    }
}

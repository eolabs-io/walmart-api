<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Command;

use Illuminate\Console\Command;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Events\FetchItems;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Items;

class ItemsCommand extends Command
{
    protected $signature = 'walmartApi:items';

    protected $description = 'Displays a list of all items by using either nextCursor or offset and limit query parameters';


    public function handle()
    {
        $this->info('Getting Items from Walmart.com...');

        FetchItems::dispatch(new Items);
    }
}

<?php

namespace EolabsIo\WalmartApi\Tests\Feature\Items;

use EolabsIo\WalmartApi\Tests\TestCase;
use EolabsIo\WalmartApi\Support\Facades\Items;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\WalmartApi\Tests\Factories\ItemsRequestFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Item;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Jobs\ProcessItemsResponse;

class ProcessItemsResponseTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        ItemsRequestFactory::new()->fakeItemsResponse();

        $results = Items::fetch();

        (new ProcessItemsResponse($results))->handle();
    }

    /** @test */
    public function it_can_process_items_response()
    {
        $item = Item::first();

        $this->assertEquals('WALMART_US', $item->mart);
        $this->assertEquals('2792005', $item->sku);
        $this->assertEquals('0RE1TWYTKBKH', $item->wpid);
        $this->assertEquals('59.99', $item->price->amount);
        $this->assertEquals('USD', $item->price->currency);
    }
}

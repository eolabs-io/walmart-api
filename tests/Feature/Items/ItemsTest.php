<?php

namespace EolabsIo\WalmartApi\Tests\Feature\Items;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use EolabsIo\WalmartApi\Tests\TestCase;
use EolabsIo\WalmartApi\Support\Facades\Items;
use EolabsIo\WalmartApi\Tests\Factories\ItemsRequestFactory;

class ItemsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    /** @test */
    public function it_sends_the_correct_request_for_search_query()
    {
        ItemsRequestFactory::new()->fakeSearchResponse();

        $query = 'fooQuery';
        $upc = 'barUpc';
        $gtin = 'bazGtin';

        Items::withSearchQuery($query)
            ->withSearchUPC($upc)
            ->withSearchGTIN($gtin)
            ->search();

        Http::assertSent(function ($request) use ($query, $upc, $gtin) {
            return $request->hasHeader('Authorization', 'Basic d2FsbWFydEFwaS1jbGllbnQtaWQ6d2FsbWFydEFwaS1jbGllbnQtc2VjcmV0') &&
                   $request->hasHeader('WM_QOS.CORRELATION_ID') &&
                   $request->hasHeader('WM_SVC.NAME', 'Walmart Marketplace') &&
                   $request->hasHeader('WM_SEC.ACCESS_TOKEN', 'd2FsbWFydEFwaS1jbGllbnQtaWQ6d2FsbWFydEFwaS1jbGllbnQtc2VjcmV0') &&
                   Str::startsWith($request->url(), 'https://marketplace.walmartapis.com/v3/items/walmart/search') &&
                   $request['query'] == $query &&
                   $request['upc'] == $upc &&
                   $request['gtin'] == $gtin;
        });
    }

    /** @test */
    public function it_can_get_a_valid_search_response()
    {
        ItemsRequestFactory::new()->fakeSearchResponse();

        $response = Items::search();
        $items = Arr::get($response, 'items');

        // Items
        $this->assertEquals('393016031', Arr::get($items, '0.itemId'));
        $this->assertEquals('3.799999952316284', Arr::get($items, '0.customerRating'));
        $this->assertEquals('12.989999771118164', Arr::get($items, '0.price.amount'));
    }

    /** @test */
    public function it_sends_the_correct_request_for_items_count_query()
    {
        ItemsRequestFactory::new()->fakeCountResponse();

        $status = 'PUBLISHED';
        Items::withCountPublished()
            ->count();

        Http::assertSent(function ($request) use ($status) {
            return $request->hasHeader('Authorization', 'Basic d2FsbWFydEFwaS1jbGllbnQtaWQ6d2FsbWFydEFwaS1jbGllbnQtc2VjcmV0') &&
                   $request->hasHeader('WM_QOS.CORRELATION_ID') &&
                   $request->hasHeader('WM_SVC.NAME', 'Walmart Marketplace') &&
                   $request->hasHeader('WM_SEC.ACCESS_TOKEN', 'd2FsbWFydEFwaS1jbGllbnQtaWQ6d2FsbWFydEFwaS1jbGllbnQtc2VjcmV0') &&
                   Str::startsWith($request->url(), 'https://marketplace.walmartapis.com/v3/items/count') &&
                   $request['status'] == $status;
        });
    }

    /** @test */
    public function it_can_get_a_valid_count_response()
    {
        ItemsRequestFactory::new()->fakeCountResponse();

        $response = Items::count();

        // Count
        $this->assertEquals('682', Arr::get($response, 'All'));
    }

    /** @test */
    public function it_sends_the_correct_request_for_item_query()
    {
        ItemsRequestFactory::new()->fakeItemResponse();

        $id = '06932096330348';
        Items::withProductIdTypeGTIN()
            ->withProductId($id)
            ->fetch();

        Http::assertSent(function ($request) use ($id) {
            return $request->hasHeader('Authorization', 'Basic d2FsbWFydEFwaS1jbGllbnQtaWQ6d2FsbWFydEFwaS1jbGllbnQtc2VjcmV0') &&
                   $request->hasHeader('WM_QOS.CORRELATION_ID') &&
                   $request->hasHeader('WM_SVC.NAME', 'Walmart Marketplace') &&
                   $request->hasHeader('WM_SEC.ACCESS_TOKEN', 'd2FsbWFydEFwaS1jbGllbnQtaWQ6d2FsbWFydEFwaS1jbGllbnQtc2VjcmV0') &&
                   Str::startsWith($request->url(), "https://marketplace.walmartapis.com/v3/items/{$id}") &&
                   $request['productIdType'] == 'GTIN';
        });
    }

    /** @test */
    public function it_can_get_a_valid_item_response()
    {
        ItemsRequestFactory::new()->fakeItemResponse();

        $id = '06932096330348';
        $response = Items::withProductId($id)
                        ->fetch();

        // Item
        $this->assertEquals('WALMART_US', Arr::get($response, 'ItemResponse.0.mart'));
        $this->assertEquals('0RCPILAXM0C1', Arr::get($response, 'ItemResponse.0.wpid'));
        $this->assertEquals('Baby Carriers', Arr::get($response, 'ItemResponse.0.productType'));
    }

    /** @test */
    public function it_sends_the_correct_request_for_items_query()
    {
        ItemsRequestFactory::new()->fakeItemsResponse();

        $sku = 'fooSku';
        $offset = '10';
        $limit = '234';

        Items::withSku($sku)
            ->withOffset($offset)
            ->withLimit($limit)
            ->fetch();

        Http::assertSent(function ($request) use ($sku, $offset, $limit) {
            return $request->hasHeader('Authorization', 'Basic d2FsbWFydEFwaS1jbGllbnQtaWQ6d2FsbWFydEFwaS1jbGllbnQtc2VjcmV0') &&
                   $request->hasHeader('WM_QOS.CORRELATION_ID') &&
                   $request->hasHeader('WM_SVC.NAME', 'Walmart Marketplace') &&
                   $request->hasHeader('WM_SEC.ACCESS_TOKEN', 'd2FsbWFydEFwaS1jbGllbnQtaWQ6d2FsbWFydEFwaS1jbGllbnQtc2VjcmV0') &&
                   Str::startsWith($request->url(), "https://marketplace.walmartapis.com/v3/items") &&
                   $request['sku'] == $sku &&
                   $request['offset'] == $offset &&
                   $request['limit'] == $limit;
        });
    }

    /** @test */
    public function it_can_get_a_valid_items_response()
    {
        ItemsRequestFactory::new()->fakeItemsResponse();

        $response = Items::fetch();

        // Items
        $this->assertEquals('WALMART_US', Arr::get($response, 'ItemResponse.0.mart'));
        $this->assertEquals('0RE1TWYTKBKH', Arr::get($response, 'ItemResponse.0.wpid'));
        $this->assertEquals('Outerwear Coats, Jackets & Vests', Arr::get($response, 'ItemResponse.0.productType'));
        $this->assertEquals('WALMART_US', Arr::get($response, 'ItemResponse.5.mart'));
        $this->assertEquals('0RLL9EUVVD10', Arr::get($response, 'ItemResponse.6.wpid'));
        $this->assertEquals('Outerwear Coats, Jackets & Vests', Arr::get($response, 'ItemResponse.2.productType'));
        $this->assertEquals(11440, Arr::get($response, 'totalItems'));
        $this->assertEquals("AoE/GjBSWFpNSFlPRjNZTjBTRUxMRVJfT0ZGRVI1QUFDOTZFNzcyRjc0NkE1OTU5QjUxQTdGMUJFQTY5OQ==", Arr::get($response, 'nextCursor'));
    }

    /** @test */
    public function it_sends_the_correct_request_for_retire_item_query()
    {
        ItemsRequestFactory::new()->fakeRetireResponse();

        $sku = 'fooSku';

        Items::retire($sku);

        Http::assertSent(function ($request) use ($sku) {
            return $request->hasHeader('Authorization', 'Basic d2FsbWFydEFwaS1jbGllbnQtaWQ6d2FsbWFydEFwaS1jbGllbnQtc2VjcmV0') &&
                   $request->hasHeader('WM_QOS.CORRELATION_ID') &&
                   $request->hasHeader('WM_SVC.NAME', 'Walmart Marketplace') &&
                   $request->hasHeader('WM_SEC.ACCESS_TOKEN', 'd2FsbWFydEFwaS1jbGllbnQtaWQ6d2FsbWFydEFwaS1jbGllbnQtc2VjcmV0') &&
                   $request->url() == "https://marketplace.walmartapis.com/v3/items/{$sku}";
        });
    }

    /** @test */
    public function it_can_get_a_valid_retire_item_response()
    {
        ItemsRequestFactory::new()->fakeRetireResponse();

        $sku = '97964_KFTest';

        $response = Items::retire($sku);

        // Retired Item Message
        $this->assertEquals('97964_KFTest', Arr::get($response, 'sku'));
        $this->assertNull(Arr::get($response, 'additionalAttributes'));
        $this->assertNull(Arr::get($response, 'errors'));
    }
}

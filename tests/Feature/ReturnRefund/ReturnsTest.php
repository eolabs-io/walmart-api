<?php

namespace EolabsIo\WalmartApi\Tests\Feature\Orders;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use EolabsIo\WalmartApi\Tests\TestCase;
use EolabsIo\WalmartApi\Support\Facades\Returns;
use EolabsIo\WalmartApi\Tests\Factories\ReturnsRequestFactory;

class ReturnsTest extends TestCase
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
    public function it_sends_the_correct_request_for_returns_query()
    {
        ReturnsRequestFactory::new()->fakeResponse();

        $id = 'roId';

        Returns::withReturnOrderId($id)
            ->fetch();

        Http::assertSent(function ($request) use ($id) {
            return $request->hasHeader('Authorization', 'Basic d2FsbWFydEFwaS1jbGllbnQtaWQ6d2FsbWFydEFwaS1jbGllbnQtc2VjcmV0') &&
                   $request->hasHeader('WM_QOS.CORRELATION_ID') &&
                   $request->hasHeader('WM_SVC.NAME', 'Walmart Marketplace') &&
                   $request->hasHeader('WM_SEC.ACCESS_TOKEN', 'd2FsbWFydEFwaS1jbGllbnQtaWQ6d2FsbWFydEFwaS1jbGllbnQtc2VjcmV0') &&
                   Str::startsWith($request->url(), "https://marketplace.walmartapis.com/v3/returns") &&
                   $request['returnOrderId'] == $id;
        });
    }

    /** @test */
    public function it_can_get_orders_with_next_cursor()
    {
        ReturnsRequestFactory::new()->fakeReturnsNextCursorResponse();

        $returns = Returns::withlimit(10);
        $response = $returns->fetch();

        $this->assertTrue($returns->hasNextCursor());

        $nextCursorResponse = $returns->fetch();

        $this->assertArrayHasKey('returnOrders', $response->toArray());
        $this->assertArrayHasKey('returnOrders', $nextCursorResponse->toArray());

        $returnOrderId = data_get($response, 'returnOrders.0.returnOrderId');
        $returnOrderId2 = data_get($nextCursorResponse, 'returnOrders.0.returnOrderId');

        $this->assertEquals('103738048909818825', $returnOrderId);
        $this->assertEquals('108903738049818825', $returnOrderId2);

        $this->assertSentReturns();
        $this->assertSentReturnsByNextCursor();
    }



    /** @test */
    public function it_can_get_a_valid_orders_response()
    {
        ReturnsRequestFactory::new()->fakeReturnsResponse();

        $response = Returns::fetch();

        // Returns
        $this->assertEquals(40, Arr::get($response, 'meta.totalCount'));
        $this->assertEquals("?sellerId=151&limit=10&offset=10", Arr::get($response, 'meta.nextCursor'));
        $this->assertEquals('103738048909818825', Arr::get($response, 'returnOrders.0.returnOrderId'));
        $this->assertEquals(1, Arr::get($response, 'returnOrders.0.returnLineGroups.0.groupNo'));
    }

    public function assertSentReturns()
    {
        $requestResponsePairs = Http::recorded($cb = null);
        $request = $requestResponsePairs[2][0];

        $this->assertTrue(
            $request->url() == 'https://marketplace.walmartapis.com/v3/returns?limit=10'
        );
    }

    public function assertSentReturnsByNextCursor()
    {
        $requestResponsePairs = Http::recorded($cb = null);
        $request = $requestResponsePairs[5][0];

        $this->assertTrue(
            $request->url() == 'https://marketplace.walmartapis.com/v3/returns?sellerId=151&limit=10&offset=10'
        );
    }
}

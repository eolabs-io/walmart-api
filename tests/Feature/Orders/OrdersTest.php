<?php

namespace EolabsIo\WalmartApi\Tests\Feature\Orders;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use EolabsIo\WalmartApi\Tests\TestCase;
use EolabsIo\WalmartApi\Support\Facades\Orders;
use EolabsIo\WalmartApi\Tests\Factories\OrdersRequestFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderLine;

class OrdersTest extends TestCase
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
    public function it_sends_the_correct_request_for_order_query()
    {
        OrdersRequestFactory::new()->fakeOrderResponse();

        $id = 'poId';

        Orders::withPurchaseOrderId($id)
            ->withProductInfo()
            ->fetchOne();

        Http::assertSent(function ($request) use ($id) {
            return $request->hasHeader('Authorization', 'Basic d2FsbWFydEFwaS1jbGllbnQtaWQ6d2FsbWFydEFwaS1jbGllbnQtc2VjcmV0') &&
                   $request->hasHeader('WM_QOS.CORRELATION_ID') &&
                   $request->hasHeader('WM_SVC.NAME', 'Walmart Marketplace') &&
                   $request->hasHeader('WM_SEC.ACCESS_TOKEN', 'd2FsbWFydEFwaS1jbGllbnQtaWQ6d2FsbWFydEFwaS1jbGllbnQtc2VjcmV0') &&
                   Str::startsWith($request->url(), "https://marketplace.walmartapis.com/v3/orders/{$id}") &&
                   $request['productInfo'] == true;
        });
    }

    /** @test */
    public function it_can_get_a_valid_order_response()
    {
        OrdersRequestFactory::new()->fakeOrderResponse();

        $id = 1792410114462;
        $response = Orders::withPurchaseOrderId($id)
                        ->withProductInfo()
                        ->fetchOne();

        // Order
        $this->assertEquals('1792410114462', Arr::get($response, 'order.purchaseOrderId'));
        $this->assertEquals('5101900976745', Arr::get($response, 'order.customerOrderId'));
        $this->assertEquals('mannavarapu@walmartlabs.com', Arr::get($response, 'order.customerEmailId'));
        $this->assertEquals('52e3962d-90e4-46e1-ab1c-ba579fac5a39', Arr::get($response, 'order.buyerId'));
        $this->assertEquals('Suresh R', Arr::get($response, 'order.shippingInfo.postalAddress.name'));
    }

    /** @test */
    public function it_sends_the_correct_request_for_orders_query()
    {
        OrdersRequestFactory::new()->fakeOrdersResponse();

        $createdStartDate = '2020-12-08T21:16:03+00:00';
        $createdStartDateAsCarbon = Carbon::parse($createdStartDate);

        Orders::withCreatedStartDate($createdStartDateAsCarbon)->fetch();

        Http::assertSent(function ($request) use ($createdStartDate) {
            return $request->hasHeader('Authorization', 'Basic d2FsbWFydEFwaS1jbGllbnQtaWQ6d2FsbWFydEFwaS1jbGllbnQtc2VjcmV0') &&
                   $request->hasHeader('WM_QOS.CORRELATION_ID') &&
                   $request->hasHeader('WM_SVC.NAME', 'Walmart Marketplace') &&
                   $request->hasHeader('WM_SEC.ACCESS_TOKEN', 'd2FsbWFydEFwaS1jbGllbnQtaWQ6d2FsbWFydEFwaS1jbGllbnQtc2VjcmV0') &&
                   Str::startsWith($request->url(), "https://marketplace.walmartapis.com/v3/orders") &&
                   $request['createdStartDate'] == $createdStartDate;
        });
    }

    /** @test */
    public function it_can_get_orders_with_next_cursor()
    {
        OrdersRequestFactory::new()->fakeOrdersNextCursorResponse();

        $orders = Orders::withlimit(10);
        $response = $orders->fetch();

        $this->assertTrue($orders->hasNextCursor());

        $nextCursorResponse = $orders->fetch();

        $this->assertArrayHasKey('list', $response->toArray());
        $this->assertArrayHasKey('list', $nextCursorResponse->toArray());

        $purchaseOrderId = data_get($response, 'list.elements.order.0.purchaseOrderId');
        $purchaseOrderId2 = data_get($nextCursorResponse, 'list.elements.order.0.purchaseOrderId');

        $this->assertEquals('1796277083022', $purchaseOrderId);
        $this->assertEquals('3906277083742', $purchaseOrderId2);

        $this->assertSentOrders();
        $this->assertSentOrdersByNextCursor();
    }



    /** @test */
    public function it_can_get_a_valid_orders_response()
    {
        OrdersRequestFactory::new()->fakeOrdersResponse();

        $createdStartDate = '2020-12-08T21:16:03+00:00';
        $createdStartDateAsCarbon = Carbon::parse($createdStartDate);

        $response = Orders::withCreatedStartDate($createdStartDateAsCarbon)->fetch();

        // Orders
        $this->assertEquals(31, Arr::get($response, 'list.meta.totalCount'));
        $this->assertEquals("?limit=10&hasMoreElements=true&soIndex=31&poIndex=10&partnerId=100009&sellerId=8&createdStartDate=2013-08-16&createdEndDate=2019-09-17T18:47:03.703Z", Arr::get($response, 'list.meta.nextCursor'));
        $this->assertEquals('5281956426648', Arr::get($response, 'list.elements.order.0.customerOrderId'));
        $this->assertEquals('Value', Arr::get($response, 'list.elements.order.0.shippingInfo.methodCode'));
    }

    /** @test */
    public function it_sends_the_correct_request_for_acknowledge_query()
    {
        OrdersRequestFactory::new()->fakeAcknowledgeResponse();

        $purchaseOrderId = '1796277083022';

        Orders::acknowledge($purchaseOrderId);

        Http::assertSent(function ($request) use ($purchaseOrderId) {
            return $request->hasHeader('Authorization', 'Basic d2FsbWFydEFwaS1jbGllbnQtaWQ6d2FsbWFydEFwaS1jbGllbnQtc2VjcmV0') &&
                     $request->hasHeader('WM_QOS.CORRELATION_ID') &&
                     $request->hasHeader('WM_SVC.NAME', 'Walmart Marketplace') &&
                     $request->hasHeader('WM_SEC.ACCESS_TOKEN', 'd2FsbWFydEFwaS1jbGllbnQtaWQ6d2FsbWFydEFwaS1jbGllbnQtc2VjcmV0') &&
                     $request->url() == "https://marketplace.walmartapis.com/v3/orders/{$purchaseOrderId}/acknowledge";
        });
    }

    /** @test */
    public function it_can_get_a_valid_acknowledge_response()
    {
        OrdersRequestFactory::new()->fakeAcknowledgeResponse();

        $purchaseOrderId = '1796277083022';
        $response = Orders::acknowledge($purchaseOrderId);

        // Acknowledged Orders
        $this->assertEquals('1796277083022', Arr::get($response, 'order.purchaseOrderId'));
        $this->assertEquals("5281956426648", Arr::get($response, 'order.customerOrderId'));
        $this->assertEquals('3A31739D8B0A45A1B23F7F8C81C8747F@relay.walmart.com', Arr::get($response, 'order.customerEmailId'));
    }


    // public function it_sends_the_correct_request_for_cancel_query()
    // {
    //     OrdersRequestFactory::new()->fakeAcknowledgeResponse();

    //     $purchaseOrderId = '1796277083022';
    //     $orderLines = OrderLine::factory()->has()->create();
    //     $parameters = $orderLines->toRequestBody();

    //     dd($parameters);
    //     Orders::cancelOrderLines($purchaseOrderId, $parameters);

    //     Http::assertSent(function ($request) use ($purchaseOrderId) {
    //         return $request->hasHeader('Authorization', 'Basic d2FsbWFydEFwaS1jbGllbnQtaWQ6d2FsbWFydEFwaS1jbGllbnQtc2VjcmV0') &&
    //                   $request->hasHeader('WM_QOS.CORRELATION_ID') &&
    //                   $request->hasHeader('WM_SVC.NAME', 'Walmart Marketplace') &&
    //                   $request->hasHeader('WM_SEC.ACCESS_TOKEN', 'd2FsbWFydEFwaS1jbGllbnQtaWQ6d2FsbWFydEFwaS1jbGllbnQtc2VjcmV0') &&
    //                   $request->url() == "https://marketplace.walmartapis.com/v3/orders/{$purchaseOrderId}/acknowledge";
    //     });
    // }


    // public function it_can_get_a_valid_cancel_response()
    // {
    //     OrdersRequestFactory::new()->fakeAcknowledgeResponse();

    //     $purchaseOrderId = '1796277083022';
    //     $response = Orders::cancelOrderLines($purchaseOrderId);

    //     // Acknowledged Orders
    //     $this->assertEquals('1796277083022', Arr::get($response, 'order.purchaseOrderId'));
    //     $this->assertEquals("5281956426648", Arr::get($response, 'order.customerOrderId'));
    //     $this->assertEquals('3A31739D8B0A45A1B23F7F8C81C8747F@relay.walmart.com', Arr::get($response, 'order.customerEmailId'));
    // }

    public function assertSentOrders()
    {
        $requestResponsePairs = Http::recorded($cb = null);
        $request = $requestResponsePairs[2][0];

        $this->assertTrue(
            $request->url() == 'https://marketplace.walmartapis.com/v3/orders?limit=10&productInfo=0&shipNodeType=SellerFulfilled'
        );
    }

    public function assertSentOrdersByNextCursor()
    {
        $requestResponsePairs = Http::recorded($cb = null);
        $request = $requestResponsePairs[5][0];

        $this->assertTrue(
            $request->url() == 'https://marketplace.walmartapis.com/v3/orders?limit=10&hasMoreElements=true&soIndex=31&poIndex=10&partnerId=100009&sellerId=8&createdStartDate=2013-08-16&createdEndDate=2019-09-17T18%3A47%3A03.703Z'
        );
    }
}

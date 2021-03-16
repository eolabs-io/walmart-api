<?php

namespace EolabsIo\WalmartApi\Tests\Factories;

use Illuminate\Support\Facades\Http;
use EolabsIo\WalmartApi\Tests\Factories\AuthRequestFactory;

class OrdersRequestFactory
{
    private $endpoint = 'https://marketplace.walmartapis.com/v3/orders';

    public static function new(): self
    {
        return new static();
    }

    public function fake(): self
    {
        Http::fake();

        return $this;
    }

    public function fakeOrderResponse(): self
    {
        AuthRequestFactory::new()->fakeResponse();

        $file = __DIR__ . '/../Stubs/Responses/fetchOrder.json';
        $response = file_get_contents($file);

        Http::fake([
             $this->endpoint. '*' => Http::sequence()
                                    ->push($response, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);


        return $this;
    }

    public function fakeOrdersResponse(): self
    {
        AuthRequestFactory::new()->fakeResponse();

        $file = __DIR__ . '/../Stubs/Responses/fetchOrders.json';
        $response = file_get_contents($file);

        Http::fake([
             $this->endpoint. '*' => Http::sequence()
                                    ->push($response, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);


        return $this;
    }

    public function fakeOrdersWithoutNextCursorResponse(): self
    {
        AuthRequestFactory::new()->fakeResponse();

        $file = __DIR__ . '/../Stubs/Responses/fetchOrdersWithoutNextCursor.json';
        $response = file_get_contents($file);

        Http::fake([
             $this->endpoint. '*' => Http::sequence()
                                    ->push($response, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);


        return $this;
    }

    public function fakeOrdersNextCursorResponse(): self
    {
        AuthRequestFactory::new()->fakeResponseAlwaysValid();

        $file = __DIR__ . '/../Stubs/Responses/fetchOrders.json';
        $response = file_get_contents($file);

        $file = __DIR__ . '/../Stubs/Responses/fetchOrdersWithoutNextCursor.json';
        $responseWithoutNextCursor = file_get_contents($file);

        Http::fake([
            $this->endpoint. '*' => Http::sequence()
                                ->push($response, 200)
                                ->push($responseWithoutNextCursor, 200)
                                ->whenEmpty(Http::response('', 404)),
        ]);

        return $this;
    }

    public function fakeAcknowledgeResponse()
    {
        AuthRequestFactory::new()->fakeResponse();

        $file = __DIR__ . '/../Stubs/Responses/fetchOrdersAcknowledge.json';
        $response = file_get_contents($file);

        Http::fake([
             $this->endpoint. '*' => Http::sequence()
                                    ->push($response, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);


        return $this;
    }

    public function fakeResponse(): self
    {
        $this->fakeOrdersResponse();

        return $this;
    }

    public function fakeResponseWithError(): self
    {
        return $this;
    }
}

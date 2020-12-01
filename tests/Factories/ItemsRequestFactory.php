<?php

namespace EolabsIo\WalmartApi\Tests\Factories;

use Illuminate\Support\Facades\Http;
use EolabsIo\WalmartApi\Tests\Factories\AuthRequestFactory;

class ItemsRequestFactory
{
    private $endpoint = 'https://marketplace.walmartapis.com/v3/items';

    public static function new(): self
    {
        return new static();
    }

    public function fake(): self
    {
        Http::fake();

        return $this;
    }

    public function fakeSearchResponse(): self
    {
        AuthRequestFactory::new()->fakeResponse();

        $file = __DIR__ . '/../Stubs/Responses/fetchItemSearch.json';
        $response = file_get_contents($file);

        Http::fake([
             $this->endpoint.'/walmart/search*' => Http::sequence()
                                    ->push($response, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);


        return $this;
    }

    public function fakeCountResponse(): self
    {
        AuthRequestFactory::new()->fakeResponse();

        $file = __DIR__ . '/../Stubs/Responses/fetchItemCount.json';
        $response = file_get_contents($file);

        Http::fake([
             $this->endpoint.'/count*' => Http::sequence()
                                    ->push($response, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);


        return $this;
    }

    public function fakeItemResponse(): self
    {
        AuthRequestFactory::new()->fakeResponse();

        $file = __DIR__ . '/../Stubs/Responses/fetchItem.json';
        $response = file_get_contents($file);

        Http::fake([
             $this->endpoint.'/*' => Http::sequence()
                                    ->push($response, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);


        return $this;
    }

    public function fakeItemsResponse(): self
    {
        AuthRequestFactory::new()->fakeResponse();

        $file = __DIR__ . '/../Stubs/Responses/fetchItems.json';
        $response = file_get_contents($file);

        Http::fake([
             $this->endpoint. '*' => Http::sequence()
                                    ->push($response, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);


        return $this;
    }

    public function fakeItemsWithoutNextCursorResponse(): self
    {
        AuthRequestFactory::new()->fakeResponse();

        $file = __DIR__ . '/../Stubs/Responses/fetchItemsWithoutNextCursor.json';
        $response = file_get_contents($file);

        Http::fake([
             $this->endpoint. '*' => Http::sequence()
                                    ->push($response, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);


        return $this;
    }

    public function fakeRetireResponse(): self
    {
        AuthRequestFactory::new()->fakeResponse();

        $file = __DIR__ . '/../Stubs/Responses/fetchRetireItem.json';
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
        $this
            ->fakeSearchResponse()
            ->fakeCountResponse()
            ->fakeItemResponse()
            ->fakeItemsResponse();

        return $this;
    }

    public function fakeResponseWithError(): self
    {
        return $this;
    }
}

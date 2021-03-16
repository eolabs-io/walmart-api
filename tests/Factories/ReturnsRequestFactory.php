<?php

namespace EolabsIo\WalmartApi\Tests\Factories;

use Illuminate\Support\Facades\Http;
use EolabsIo\WalmartApi\Tests\Factories\AuthRequestFactory;

class ReturnsRequestFactory
{
    private $endpoint = 'https://marketplace.walmartapis.com/v3/returns';

    public static function new(): self
    {
        return new static();
    }

    public function fake(): self
    {
        Http::fake();

        return $this;
    }

    public function fakeReturnsResponse(): self
    {
        AuthRequestFactory::new()->fakeResponse();

        $file = __DIR__ . '/../Stubs/Responses/fetchReturns.json';
        $response = file_get_contents($file);

        Http::fake([
             $this->endpoint. '*' => Http::sequence()
                                    ->push($response, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);


        return $this;
    }

    public function fakeReturnsWithoutNextCursorResponse(): self
    {
        AuthRequestFactory::new()->fakeResponse();

        $file = __DIR__ . '/../Stubs/Responses/fetchReturnsWithoutNextCursor.json';
        $response = file_get_contents($file);

        Http::fake([
             $this->endpoint. '*' => Http::sequence()
                                    ->push($response, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);


        return $this;
    }

    public function fakeReturnsNextCursorResponse(): self
    {
        AuthRequestFactory::new()->fakeResponseAlwaysValid();

        $file = __DIR__ . '/../Stubs/Responses/fetchReturns.json';
        $response = file_get_contents($file);

        $file = __DIR__ . '/../Stubs/Responses/fetchReturnsWithoutNextCursor.json';
        $responseWithoutNextCursor = file_get_contents($file);

        Http::fake([
            $this->endpoint. '*' => Http::sequence()
                                ->push($response, 200)
                                ->push($responseWithoutNextCursor, 200)
                                ->whenEmpty(Http::response('', 404)),
        ]);

        return $this;
    }


    public function fakeResponse(): self
    {
        $this->fakeReturnsResponse();

        return $this;
    }

    public function fakeResponseWithError(): self
    {
        return $this;
    }
}

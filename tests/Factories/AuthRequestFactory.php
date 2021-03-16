<?php

namespace EolabsIo\WalmartApi\Tests\Factories;

use Illuminate\Support\Facades\Http;

class AuthRequestFactory
{
    private $endpoint = 'https://marketplace.walmartapis.com/v3/token';

    public static function new(): self
    {
        return new static();
    }

    public function fake(): self
    {
        Http::fake();

        return $this;
    }

    public function fakeResponse(): self
    {
        $file = __DIR__ . '/../Stubs/Responses/fetchToken.json';
        $tokenResponse = file_get_contents($file);

        $file = __DIR__ . '/../Stubs/Responses/fetchToken2.json';
        $token2Response = file_get_contents($file);

        $file = __DIR__ . '/../Stubs/Responses/fetchTokenDetail.json';
        $tokenDetailResponse = file_get_contents($file);

        Http::fake([
             $this->endpoint => Http::sequence()
                                    ->push($tokenResponse, 200)
                                    ->push($token2Response, 200)
                                    ->whenEmpty(Http::response('', 404)),
            $this->endpoint.'/detail' => Http::sequence()
                                    ->push($tokenDetailResponse, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);



        return $this;
    }

    public function fakeResponseAlwaysValid(): self
    {
        $file = __DIR__ . '/../Stubs/Responses/fetchToken.json';
        $tokenResponse = file_get_contents($file);

        $file = __DIR__ . '/../Stubs/Responses/fetchTokenDetail.json';
        $tokenDetailResponse = file_get_contents($file);

        Http::fake([
            $this->endpoint => Http::response($tokenResponse, 200),

            $this->endpoint.'/detail' => Http::response($tokenDetailResponse, 200),
        ]);


        return $this;
    }

    public function fakeResponseWithError(): self
    {
        return $this;
    }
}

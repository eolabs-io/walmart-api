<?php

namespace EolabsIo\WalmartApi\Tests\Factories;

use Illuminate\Support\Facades\Http;
use EolabsIo\WalmartApi\Tests\Factories\AuthRequestFactory;

class TaxonomyRequestFactory
{
    private $endpoint = 'https://marketplace.walmartapis.com/v3/items/taxonomy';

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
        AuthRequestFactory::new()->fakeResponse();

        $file = __DIR__ . '/../Stubs/Responses/fetchGetTaxonomy.json';
        $response = file_get_contents($file);

        Http::fake([
             $this->endpoint => Http::sequence()
                                    ->push($response, 200)
                                    ->whenEmpty(Http::response('', 404)),
        ]);

        return $this;
    }

    public function fakeResponseWithError(): self
    {
        return $this;
    }
}

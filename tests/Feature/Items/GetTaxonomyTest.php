<?php

namespace EolabsIo\WalmartApi\Tests\Feature\Items;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use EolabsIo\WalmartApi\Tests\TestCase;
use EolabsIo\WalmartApi\Support\Facades\GetTaxonomy;
use EolabsIo\WalmartApi\Tests\Factories\TaxonomyRequestFactory;

class GetTaxonomyTest extends TestCase
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
    public function it_sends_the_correct_request_query()
    {
        TaxonomyRequestFactory::new()->fakeResponse();

        GetTaxonomy::fetch();

        Http::assertSent(function ($request) {
            return $request->hasHeader('Authorization', 'Basic d2FsbWFydEFwaS1jbGllbnQtaWQ6d2FsbWFydEFwaS1jbGllbnQtc2VjcmV0') &&
                   $request->hasHeader('WM_QOS.CORRELATION_ID') &&
                   $request->hasHeader('WM_SVC.NAME', 'Walmart Marketplace') &&
                   $request->hasHeader('WM_SEC.ACCESS_TOKEN', 'd2FsbWFydEFwaS1jbGllbnQtaWQ6d2FsbWFydEFwaS1jbGllbnQtc2VjcmV0') &&
                   $request->url() == 'https://marketplace.walmartapis.com/v3/items/taxonomy';
        });
    }

    /** @test */
    public function it_can_get_a_valid_taxonomy()
    {
        TaxonomyRequestFactory::new()->fakeResponse();

        $response = GetTaxonomy::fetch();
        $taxonomies = Arr::get($response, 'payload');

        // Taxonomy
        $this->assertEquals('Animal', Arr::get($taxonomies, '0.category'));
        $this->assertEquals('Animal Health & Grooming', Arr::get($taxonomies, '0.subcategory.2.subCategoryName'));
        $this->assertEquals('56f2eb66208f9a06158f1748', Arr::get($taxonomies, '0.subcategory.3.subCategoryId'));
    }
}

<?php

namespace EolabsIo\WalmartApi\Tests\Feature\Items;

use Illuminate\Support\Arr;
use EolabsIo\WalmartApi\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\WalmartApi\Support\Facades\GetTaxonomy;
use EolabsIo\WalmartApi\Tests\Factories\TaxonomyRequestFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Taxonomy;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Jobs\ProcessGetTaxonomyResponse;

class ProcessGetTaxonomyResponseTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();

        TaxonomyRequestFactory::new()->fakeResponse();

        $results = GetTaxonomy::fetch();

        (new ProcessGetTaxonomyResponse($results))->handle();
    }

    /** @test */
    public function it_can_process_list_orders_response()
    {
        $taxonomy = Taxonomy::first();

        $this->assertEquals('Animal', $taxonomy->category);

        $subcategories = $taxonomy->subcategories->toArray();

        $this->assertEquals(Arr::get($subcategories, '0.sub_category_name'), 'Animal Accessories');
        $this->assertEquals(Arr::get($subcategories, '1.sub_category_id'), '559c5d8f4fff3d64de18bf3d');
        $this->assertEquals(Arr::get($subcategories, '3.sub_category_name'), 'Animal Other');
    }
}

<?php

namespace EolabsIo\WalmartApi\Tests\Feature\Items;

use EolabsIo\WalmartApi\Tests\TestCase;
use EolabsIo\WalmartApi\Support\Facades\Items;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\WalmartApi\Tests\Factories\ItemsRequestFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Jobs\ProcessItemSearchResponse;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\ItemVariant;

class ProcessItemSearchResponseTest extends TestCase
{
    use RefreshDatabase;

    public $upc = '11-1111-1111';

    protected function setUp(): void
    {
        parent::setUp();

        ItemsRequestFactory::new()->fakeSearchResponse();

        $results = Items::withSearchUPC($this->upc)->search();

        (new ProcessItemSearchResponse($results))->handle();
    }

    /** @test */
    public function it_can_process_items_response()
    {
        $itemVariant = ItemVariant::with(['price', 'property'])->first();

        $this->assertEquals('393016031', $itemVariant->item_id);
        $this->assertEquals('11-1111-1111', $itemVariant->upc);
        // $this->assertNull($itemVariant->gtin);
        $this->assertTrue($itemVariant->is_market_place_item);
        $this->assertEquals(3.79999995231628, $itemVariant->customer_rating);
        $this->assertTrue($itemVariant->free_shipping);
        $this->assertEquals(1, $itemVariant->offer_count);
        $this->assertEquals('<li>Designed for Apple <mark>iPad</mark> <mark>mini</mark> 1/2/3</li><li>Hybrid Silicone/PC Protective Shell with Kickstand</li><li>Shock-Absorption <mark><mark>Case</mark>s</mark> Protection <mark>Case</mark> for boys girls</li>', $itemVariant->description);
        $this->assertEquals('<mark>iPad</mark> <mark>mini</mark> 3/ 2 /1 <mark>Case</mark>,  ULAK Three Layer Hybrid Heavy Duty Shockproof Protective <mark>Case</mark> with Kickstand for Apple <mark>iPad</mark> <mark>Mini</mark>,<mark>iPad</mark> <mark>Mini</mark> 2,<mark>iPad</mark> <mark>Mini</mark> 3', $itemVariant->title);
        $this->assertEquals('ULAK', $itemVariant->brand);
        $this->assertEquals('VARIANT', $itemVariant->product_type);

        $this->assertPrice($itemVariant->price);
        $this->assertProperty($itemVariant->property);
    }

    public function assertPrice($price)
    {
        $this->assertEquals(12.9899997711182, $price->amount);
        $this->assertEquals('USD', $price->currency);
    }
    public function assertProperty($property)
    {
        $this->assertEquals(5, $property->variant_items_num);
        $this->assertEquals(16, $property->num_reviews);
        $this->assertFalse($property->next_day_eligible);

        $this->assertCategories($property->categories);
        $this->assertVariants($property->variant);
    }

    public function assertCategories($categories)
    {
        $this->assertEquals(
            [
                "Electronics",
                "iPad & Tablets",
                "Apple iPad Accessories",
                "iPad Cases, Sleeves & Bags",
            ],
            $categories->pluck('name')->toArray()
        );
    }

    public function assertVariants($variant)
    {
        $this->assertVariantMeta($variant->variantMeta->first());
        $this->assertVariantData($variant->variantData->first());
    }

    public function assertVariantMeta($variantMeta)
    {
        $this->assertEquals('actual_color', $variantMeta->name);
    }

    public function assertVariantData($variantData)
    {
        $this->assertEquals('https://i5.walmartimages.com/asr/82b8c484-651b-4e50-979c-42164649b8c5_1.bcf0b3a35d5767ee402c06b26a25f191.jpeg?odnHeight=180&odnWidth=180&odnBg=ffffff', $variantData->product_image_url);
        $this->assertEquals(936491618, $variantData->item_id);
        $this->assertEquals('Y', $variantData->is_available);
        $this->assertEquals('iPad mini 3/ 2 /1 Case,  ULAK Three Layer Hybrid Heavy Duty Shockproof Protective Case with Kickstand for Apple iPad Mini,iPad Mini 2,iPad Mini 3', $variantData->title);

        $this->assertVariantValues($variantData->variantValues->first());
    }

    public function assertVariantValues($variantValues)
    {
        $this->assertEquals('actual_color', $variantValues->name);
        $this->assertEquals('Black/Black', $variantValues->value);
    }
}

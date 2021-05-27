<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Items;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Image;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Price;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\ItemVariant;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Property;

class ItemVariantTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return ItemVariant::class;
    }

    /** @test */
    public function it_has_price_relationship()
    {
        $expectedPrice = Price::factory()->create();
        ItemVariant::factory()->create(['price_id' => $expectedPrice->id]);

        $actualPrice = ItemVariant::with('price')->first()->price;

        $this->assertEquals($expectedPrice->toArray(), $actualPrice->toArray());
    }


    /** @test */
    public function it_has_images_relationship()
    {
        $itemVariant = ItemVariant::factory()->create();

        $expectedImages = Image::factory()->times(3)->create(['item_variant_id' => $itemVariant->id]);

        $actualImages = ItemVariant::with('images')->first()->images;

        $this->assertEquals($expectedImages->toArray(), $actualImages->toArray());
    }

    /** @test */
    public function it_has_properties_relationship()
    {
        $expectedProperty = Property::factory()->create();
        ItemVariant::factory()->create(['property_id' => $expectedProperty->id]);


        $actualProperty = ItemVariant::with('property')->first()->property;

        $this->assertEquals($expectedProperty->toArray(), $actualProperty->toArray());
    }
}

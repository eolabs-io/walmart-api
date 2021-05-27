<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Items;

use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Category;
use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Variant;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Property;

class PropertyTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Property::class;
    }

    /** @test */
    public function it_has_variants_relationship()
    {
        $expectedVariant = Variant::factory()->create();
        Property::factory()->create([
                'variant_id' => $expectedVariant->id,
        ]);
        $actualVariant = Property::with('variant')->first()->variant;


        $this->assertEquals($expectedVariant->toArray(), $actualVariant->toArray());
    }


    /** @test */
    public function it_has_categories_relationship()
    {
        $property = Property::factory()->create();
        $expectedCategories = Category::factory()->times(3)->create(['property_id' => $property->id]);

        $actualCategories = Property::with('categories')->first()->categories;

        $this->assertEquals($expectedCategories->toArray(), $actualCategories->toArray());
    }
}

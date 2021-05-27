<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Items;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Variant;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\VariantData;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\VariantMeta;

class VariantTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Variant::class;
    }

    /** @test */
    public function it_has_variant_meta_relationship()
    {
        $variant = Variant::factory()->create();
        $expectedVariantMeta = VariantMeta::factory()->times(3)->create([
            'variant_id' => $variant->id,
        ]);

        $actualVariantMeta = Variant::with('variantMeta')->first()->variantMeta;

        $this->assertEquals($expectedVariantMeta->toArray(), $actualVariantMeta->toArray());
    }


    /** @test */
    public function it_has_variant_data_relationship()
    {
        $variant = Variant::factory()->create();
        $expectedVariantData = VariantData::factory()->times(3)->create([
            'variant_id' => $variant->id,
        ]);

        $actualVariantData = Variant::with('variantData')->first()->variantData;

        $this->assertEquals($expectedVariantData->toArray(), $actualVariantData->toArray());
    }
}

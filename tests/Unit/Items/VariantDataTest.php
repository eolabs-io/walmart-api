<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Items;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\VariantData;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\VariantValue;

class VariantDataTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return VariantData::class;
    }

    /** @test */
    public function it_has_variant_values_relationship()
    {
        $expectedVariantData = VariantData::factory()->create();
        $expectedVariantValues = VariantValue::factory()->times(3)->create([
                    'variant_data_id' => $expectedVariantData->id,
        ]);

        $actualVariantValues = VariantData::with('variantValues')->first()->variantValues;

        $this->assertEquals($expectedVariantValues->toArray(), $actualVariantValues->toArray());
    }
}

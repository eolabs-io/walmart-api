<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\VariantData;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\VariantValue;

class VariantValueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VariantValue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text,
            'value' => $this->faker->text,
            'variant_data_id' => VariantData::factory(),
        ];
    }
}

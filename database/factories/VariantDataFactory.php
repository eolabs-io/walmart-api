<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Variant;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\VariantData;

class VariantDataFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VariantData::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'variant_id' => Variant::factory(),
            'product_image_url' => $this->faker->url,
            'item_id' => $this->faker->randomNumber(),
            'is_available' => $this->faker->text,
            'title' => $this->faker->text,
        ];
    }
}

<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Item;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Price;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mart' => $this->faker->randomElement(['WALMART_US', 'WALMART_CA', 'ASDA_GM', 'WALMART_MEXICO']),
            'sku' => Str::random(12),
            'wpid' => Str::random(12),
            'upc' => '',
            'gtin' => Str::random(12),
            'product_name' => $this->faker->text,
            'shelf' => $this->faker->text,
            'product_type' => $this->faker->text,
            'published_status' => $this->faker->randomElement(['PUBLISHED', 'READY_TO_PUBLISH', 'IN_PROGRESS', 'UNPUBLISHED', 'STAGE', 'SYSTEM_PROBLEM']),
            'lifecycle_status' => $this->faker->randomElement(['ACTIVE' , 'ARCHIVED', 'RETIRED']),
            'name' => $this->faker->text,
            'price_id' => Price::factory(),
        ];
    }
}

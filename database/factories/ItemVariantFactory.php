<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Price;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\ItemVariant;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Property;

class ItemVariantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ItemVariant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'item_id' => $this->faker->randomNumber(8),
            'upc' => $this->faker->numerify('##-####-####'),
            'gtin' => null,
            'is_market_place_item' => $this->faker->boolean(95),
            'customer_rating' => $this->faker->randomFloat(4),
            'free_shipping' => $this->faker->boolean(95),
            'offer_count' => $this->faker->randomDigit,
            'price_id' => Price::factory(),
            'description' => $this->faker->text,
            'title' => $this->faker->text,
            'brand' => $this->faker->text,
            'product_type' => $this->faker->text,
            'property_id' => Property::factory(),
        ];
    }
}

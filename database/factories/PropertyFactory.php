<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Variant;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Property;

class PropertyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'variant_items_num' => $this->faker->text,
            'num_reviews' => $this->faker->randomNumber(2),
            'next_day_eligible' => $this->faker->boolean(),
            'variant_id' => Variant::factory(),
        ];
    }
}

<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Inventory\Models\InventoryQuantity;

class InventoryQuantityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InventoryQuantity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unit' => Str::random(),
            'amount' => $this->faker->randomNumber(),
        ];
    }
}

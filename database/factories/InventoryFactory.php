<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Inventory\Models\Inventory;
use EolabsIo\WalmartApi\Domain\Marketplace\Inventory\Models\InventoryQuantity;

class InventoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Inventory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sku' => $this->faker->text,
            'inventory_quantity_id' => InventoryQuantity::factory(),
        ];
    }
}

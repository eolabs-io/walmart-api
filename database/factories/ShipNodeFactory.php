<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\ShipNode;

class ShipNodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShipNode::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['SellerFulfilled', 'WFSFulfilled', '3PLFulfilled']),
            'name' => $this->faker->name,
            'ship_node_id' => Str::random(),
        ];
    }
}

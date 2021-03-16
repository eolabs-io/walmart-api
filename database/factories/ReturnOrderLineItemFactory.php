<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Weight;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnOrderLineItem;

class ReturnOrderLineItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ReturnOrderLineItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sku' => $this->faker->text,
            'product_name' => $this->faker->text,
            'item_weight_id' => Weight::factory(),
        ];
    }
}

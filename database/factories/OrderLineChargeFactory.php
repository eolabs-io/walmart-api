<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Currency;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\OrderLineCharge;

class OrderLineChargeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderLineCharge::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'charge_category' => $this->faker->randomElement(['PRODUCT', 'FEE']),
            'charge_name' => $this->faker->randomElement(['Item Price', 'SHIPPING']),
            'charge_per_unit_id' => Currency::factory(),
            'is_discount' => $this->faker->boolean,
            'is_billable' => $this->faker->boolean,
            'excess_charge_id' => Currency::factory(),
        ];
    }
}

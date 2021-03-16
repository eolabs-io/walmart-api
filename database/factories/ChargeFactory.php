<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Tax;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Charge;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Currency;

class ChargeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Charge::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = $this->faker->randomElement(['PRODUCT', 'SHIPPING']);
        $name = ($type == 'PRODUCT') ? 'Item Price' : 'Shipping';

        return [
            'charge_type' => $type,
            'charge_name' => $name,
            'charge_amount_id' => Currency::factory(),
            'tax_id' => Tax::factory(),
        ];
    }
}

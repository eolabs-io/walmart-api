<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ChargeTotal;

class ChargeTotalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChargeTotal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement([
                'lineUnitPrice',
                'lineProductTaxes',
                'lineTotalTaxes',
                'lineRestockingFee',
                'lineShippingFee',
                'lineSubTotal',
                'lineTotal',
            ]),
            'value_id' => Currency::factory(),
        ];
    }
}

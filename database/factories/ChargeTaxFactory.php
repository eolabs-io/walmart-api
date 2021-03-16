<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Currency;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ChargeTax;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\OrderLineCharge;

class ChargeTaxFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChargeTax::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tax_name' => $this->faker->text,
            'excess_tax_id' => Currency::factory(),
            'tax_per_unit_id' => Currency::factory(),
            'order_line_charge_id' => OrderLineCharge::factory(),
        ];
    }
}

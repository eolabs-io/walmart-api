<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\CarrierName;

class CarrierNameFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CarrierName::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'other_carrier' => $this->faker->text,
            'carrier' => $this->faker->randomElement(['UPS', 'USPS', 'FED_EX', 'AIRBORNE', 'ON_TRAC', 'DHL', 'NG', 'LS', 'UDS', 'UPSMI', 'FDX', 'PILOT', 'ESTES', 'SAIA']),
        ];
    }
}

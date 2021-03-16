<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\CarrierInfoList;

class CarrierInfoListFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CarrierInfoList::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'carrier_id' => $this->faker->text,
            'carrier_name' => $this->faker->name,
            'service_type' => $this->faker->text,
            'tracking_no' => $this->faker->text,
        ];
    }
}

<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnOrder;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnLineGroup;

class ReturnLineGroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ReturnLineGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'group_no' => $this->faker->randomNumber(),
            'return_expected_flag' => $this->faker->boolean,
            'return_order_id' => ReturnOrder::factory(),
        ];
    }
}

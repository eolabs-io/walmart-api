<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnLine;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnLineGroup;

class ReturnLineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ReturnLine::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'return_order_line_number' => $this->faker->randomNumber(),
            'return_line_group_id' => ReturnLineGroup::factory(),
        ];
    }
}

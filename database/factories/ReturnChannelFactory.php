<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnChannel;

class ReturnChannelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ReturnChannel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'channel_name' => $this->faker->randomElement(['ONLINE', 'IN_STORE', 'CUSTOMER_CARE',]),
        ];
    }
}

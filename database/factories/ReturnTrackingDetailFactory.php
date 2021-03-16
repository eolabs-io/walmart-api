<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnTrackingDetail;

class ReturnTrackingDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ReturnTrackingDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sequence_no' => $this->faker->randomNumber(),
            'event_tag' => 'RETURN_IN_TRANSIT',
            'event_description' => $this->faker->randomElement(['A MARKET_PLACE', 'Return in Transit',]),
            'event_time' => $this->faker->dateTime(),
        ];
    }
}

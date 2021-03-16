<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Fulfillment;

class FulfillmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Fulfillment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fulfillment_option' => $this->faker->randomElement(['S2H' , 'S2S']),
            'ship_method' => $this->faker->randomElement(['Value', 'Expedited', 'Standard', 'Rush']),
            'store_id' => Str::random(),
            'pick_up_date_time' => now()->subDays(7)->toIso8601String(),
            'pick_up_by' => now()->subDays(8)->toIso8601String(),
            'shipping_program_type' => $this->faker->randomElement(['TWO_DAY', 'THREE_DAY']),
        ];
    }
}

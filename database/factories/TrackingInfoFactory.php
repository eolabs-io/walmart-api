<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\CarrierName;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\TrackingInfo;

class TrackingInfoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TrackingInfo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ship_date_time' => now()->subDays(1)->toIso8601String(),
            'carrier_name_id' => CarrierName::factory(),
            'method_code' => $this->faker->randomElement(['STANDARD', 'EXPRESS', 'ONE_DAY', 'FREIGHT', 'WHITE_GLOVE', 'VALUE_SHIPPING']),
            'carrier_method_code' => $this->faker->randomNumber(),
            'tracking_number' => $this->faker->text,
            'tracking_url' => $this->faker->url,
        ];
    }
}

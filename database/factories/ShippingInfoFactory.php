<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\ShippingInfo;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\PostalAddress;

class ShippingInfoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShippingInfo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'phone' => $this->faker->phoneNumber,
            'estimated_delivery_date' => now()->addDays(10)->toIso8601String(),
            'estimated_ship_date' => now()->addDays(1)->toIso8601String(),
            'method_code' => $this->faker->randomElement(["STANDARD", "EXPRESS", "ONE_DAY", "FREIGHT", "WHITE_GLOVE", "VALUE_SHIPPING"]),
            'postal_address_id' => PostalAddress::factory(),
        ];
    }
}

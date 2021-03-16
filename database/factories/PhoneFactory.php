<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Phone;

class PhoneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Phone::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'phone_id' => Str::random(),
            'area_code' => $this->faker->numberBetween(100, 999),
            'extension' => $this->faker->numberBetween(1000, 9999),
            'complete_number' => $this->faker->phoneNumber,
            'type' => $this->faker->randomElement(['MOBILE', 'HOME', 'WORK']),
            'subscriber_number' => $this->faker->numberBetween(1, 9999),
            'country_code' => '+1',
        ];
    }
}

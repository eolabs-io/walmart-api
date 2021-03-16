<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Tax;

class TaxFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tax::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tax_name' => $this->faker->text,
            'tax_amount_id' => Currency::factory(),
        ];
    }
}

<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Currency;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Name;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnChannel;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnOrder;

class ReturnOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ReturnOrder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'return_order_id' => Str::random(),
            'customer_email_id' => $this->faker->email,
            'return_type' => $this->faker->randomElement(['REPLACEMENT', 'REFUND']),
            'replacement_customer_order_id' => Str::random(),
            'customer_name_id' => Name::factory(),
            'customer_order_id' => Str::random(),
            'return_order_date' => $this->faker->dateTime(),
            'return_by_date' => $this->faker->dateTime(),
            'refund_mode' => $this->faker->text,
            'total_refund_amount_id' => Currency::factory(),
            'return_channel_id' => ReturnChannel::factory(),
        ];
    }
}

<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Order;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Refund;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderItem;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderLine;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Fulfillment;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderLineQuantity;

class OrderLineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderLine::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'line_number' => Str::random(),
            'item_id' => OrderItem::factory(),
            'order_line_quantity_id' => OrderLineQuantity::factory(),
            'status_date' => now()->toIso8601String(),
            'refund_id' => Refund::factory(),
            'original_carrier_method' => $this->faker->text,
            'reference_line_id' => $this->faker->text,
            'fulfillment_id' => Fulfillment::factory(),
            'intent_to_cancel' => $this->faker->text,
            'config_id' => Str::random(),
            'seller_order_id' => Str::random(),
            'order_id' => Order::factory(),
        ];
    }
}

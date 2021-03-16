<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Order;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderSummary;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\ShipNode;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\ShippingInfo;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'purchase_order_id' => Str::random(),
            'customer_order_id' => Str::random(),
            'customer_email_id' => Str::random(),
            'order_date' => now()->subDays(7),//->toISOString(),
            'buyer_id' => Str::random(),
            'mart' => $this->faker->text,
            'is_guest' => $this->faker->boolean(),
            'shipping_info_id' => ShippingInfo::factory(),
            'order_summary_id' => OrderSummary::factory(),
            'ship_node_id' => ShipNode::factory(),
        ];
    }
}

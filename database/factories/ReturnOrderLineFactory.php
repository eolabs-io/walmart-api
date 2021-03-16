<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Currency;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\Quantity;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnOrder;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnOrderLine;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnOrderLineItem;

class ReturnOrderLineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ReturnOrderLine::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'return_order_line_number' => $this->faker->randomNumber(),
            'sales_order_line_number' => $this->faker->randomNumber(),
            'seller_order_id' => Str::random(30),
            'return_reason' => $this->faker->randomElement(['ARRIVED_LATE', 'AUTO_RETURN', 'BOUGHT_ANOTHER_SIZE_OR_COLOR', 'BOUGHT_SOMEWHERE_ELSE', 'DAMAGED', 'DEFECTIVE', 'DUPLICATE_ITEM', 'INADEQUATE_QUALITY', 'INCORRECT_ITEM', 'LOST_AFTER_DELIVERY', 'LOST_IN_TRANSIT', 'LOWER_PRICE', 'MISSING_PARTS', 'NOT_AS_DESCRIBED', 'NO_LONGER_WANTED', 'RETURN_TO_SENDER', 'SHIPPING_BOX_DAMAGED', 'TRIED_TO_CANCEL', 'WRONG_SIZE/POOR_FIT',]),
            'purchase_order_id' => Str::random(30),
            'purchase_order_line_number' => $this->faker->randomNumber(),
            'exception_item_type' => $this->faker->text,
            'is_return_for_exception' => $this->faker->boolean,
            'item_id' => ReturnOrderLineItem::factory(),
            'unit_price_id' => Currency::factory(),
            'cancellable_qty' => $this->faker->randomNumber(),
            'quantity_id' => Quantity::factory(),
            'return_expected_flag' => $this->faker->boolean,
            'is_fast_replacement' => $this->faker->boolean,
            'is_keep_it' => $this->faker->boolean,
            'last_item' => $this->faker->boolean,
            'refunded_qty' => $this->faker->randomNumber(),
            'rechargeable_qty' => $this->faker->randomNumber(),
            'refund_channel' => $this->faker->randomElement(['WALMART_SETTLED_REFUND', 'SELLER_AUTO_REFUND', 'SELLER_MANUAL_REFUND', 'SELLER_SYSTEM_REFUND', 'WALMART_TRIGGERED_REFUND']),
            'status' => 'INITIATED',
            'status_time' => $this->faker->dateTime(),
            'current_delivery_status' => $this->faker->text,
            'current_refund_status' => $this->faker->text,
            'return_order_id' => ReturnOrder::factory(),
        ];
    }
}

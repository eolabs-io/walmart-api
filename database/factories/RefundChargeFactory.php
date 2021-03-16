<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Charge;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Refund;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\RefundCharge;

class RefundChargeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RefundCharge::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'refund_reason' => $this->faker->randomElement(['BILLING_ERROR', 'TAX_EXEMPT_CUSTOMER', 'ITEM_NOT_AS_ADVERTISED', 'INCORRECT_ITEM_RECEIVED', 'CANCELLED_YET_SHIPPED', 'ITEM_NOT_RECEIVED_BY_CUSTOMER', 'INCORRECT_SHIPPING_PRICE', 'DAMAGED_ITEM', 'DEFECTIVE_ITEM', 'CUSTOMER_CHANGED_MIND', 'CUSTOMER_RECEIVED_ITEM_LATE', 'MISSING_PARTS_INSTRUCTIONS', 'FINANCE_GOODWILL', 'FINANCE_ROLLBACK', 'BUYER_CANCELED', 'CUSTOMER_RETURNED_ITEM', 'GENERAL_ADJUSTMENT', 'MERCHANDISE_NOT_RECEIVED', 'QUALITY_MISSING_PARTS_INSTRUCTIONS', 'SHIPPING_DELIVERY_DAMAGED', 'SHIPPING_DELIVERY_SHIPPING_PRICE_DISCREPANCY', 'OTHERS']),
            'charge_id' => Charge::factory(),
            'refund_id' => Refund::factory(),
        ];
    }
}

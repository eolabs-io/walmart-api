<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderLine;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\TrackingInfo;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\StatusQuantity;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderLineStatus;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\ReturnCenterAddress;

class OrderLineStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderLineStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => $this->faker->randomElement(['CREATED', 'ACKNOWLEDGED', 'SHIPPED', 'CANCELLED', 'REFUND']),
            'status_quantity_id' => StatusQuantity::factory(),
            'cancellation_reason' => $this->faker->text,
            'tracking_info_id' => TrackingInfo::factory(),
            'return_center_address_id' => ReturnCenterAddress::factory(),
            'order_line_id' => OrderLine::factory(),
        ];
    }
}

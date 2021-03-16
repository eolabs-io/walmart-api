<?php

namespace EolabsIo\WalmartApi\Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Currency;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderSummary;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderSubTotal;

class OrderSubTotalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderSubTotal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sub_total_type' => Str::random(),
            'total_amount_id' => Currency::factory(),
            'order_summary_id' => OrderSummary::factory(),
        ];
    }
}

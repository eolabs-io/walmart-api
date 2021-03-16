<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models;

use EolabsIo\WalmartApi\Database\Factories\OrderSubTotalFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Currency;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderSummary;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;

class OrderSubTotal extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'sub_total_type',
                    'total_amount_id',
                    'order_summary_id',
                ];

    public function totalAmount()
    {
        return $this->belongsTo(Currency::class, 'total_amount_id')->withDefault();
    }

    public function orderSummery()
    {
        return $this->belongsTo(OrderSummary::class)->withDefault();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return OrderSubTotalFactory::new();
    }
}

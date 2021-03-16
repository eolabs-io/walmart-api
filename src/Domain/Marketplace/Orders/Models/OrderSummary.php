<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models;

use EolabsIo\WalmartApi\Database\Factories\OrderSummaryFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Currency;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderSubTotal;

class OrderSummary extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'total_amount_id',
                ];

    public function totalAmount()
    {
        return $this->belongsTo(Currency::class, 'total_amount_id')->withDefault();
    }

    public function orderSubTotals()
    {
        return $this->hasMany(OrderSubTotal::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return OrderSummaryFactory::new();
    }
}

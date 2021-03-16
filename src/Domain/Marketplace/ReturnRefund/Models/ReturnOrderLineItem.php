<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Weight;
use EolabsIo\WalmartApi\Database\Factories\ReturnOrderLineItemFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;

class ReturnOrderLineItem extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'sku',
                    'product_name',
                    'item_weight_id',
                ];


    public function itemWeight()
    {
        return $this->belongsTo(Weight::class, 'item_weight_id')->withDefault();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ReturnOrderLineItemFactory::new();
    }
}

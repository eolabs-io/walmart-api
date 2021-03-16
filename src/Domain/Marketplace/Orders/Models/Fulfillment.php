<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models;

use EolabsIo\WalmartApi\Database\Factories\FulfillmentFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;

class Fulfillment extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'fulfillment_option',
                    'ship_method',
                    'store_id',
                    'pick_up_date_time',
                    'pick_up_by',
                    'shipping_program_type',
                ];


    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return FulfillmentFactory::new();
    }
}

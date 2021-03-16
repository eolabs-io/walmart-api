<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models;

use EolabsIo\WalmartApi\Database\Factories\ShippingInfoFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\PostalAddress;

class ShippingInfo extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'phone',
                    'estimated_delivery_date',
                    'estimated_ship_date',
                    'method_code',
                    'postal_address_id',
                ];

    public function postalAddress()
    {
        return $this->belongsTo(PostalAddress::class)->withDefault();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ShippingInfoFactory::new();
    }
}

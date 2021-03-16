<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models;

use EolabsIo\WalmartApi\Database\Factories\TrackingInfoFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\CarrierName;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;

class TrackingInfo extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'ship_date_time',
                    'carrier_name_id',
                    'method_code',
                    'carrier_method_code',
                    'tracking_number',
                    'tracking_url',
                ];

    public function carrierName()
    {
        return $this->belongsTo(CarrierName::class)->withDefault();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return TrackingInfoFactory::new();
    }
}

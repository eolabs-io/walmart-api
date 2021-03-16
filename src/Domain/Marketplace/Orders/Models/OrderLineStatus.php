<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models;

use EolabsIo\WalmartApi\Database\Factories\OrderLineStatusFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderLine;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\TrackingInfo;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\StatusQuantity;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\ReturnCenterAddress;

class OrderLineStatus extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'status',
                    'status_quantity_id',
                    'cancellation_reason',
                    'tracking_info_id',
                    'return_center_address_id',
                    'order_line_id',
                ];

    public function statusQuantity()
    {
        return $this->belongsTo(StatusQuantity::class)->withDefault();
    }

    public function trackingInfo()
    {
        return $this->belongsTo(TrackingInfo::class)->withDefault();
    }

    public function returnCenterAddress()
    {
        return $this->belongsTo(ReturnCenterAddress::class)->withDefault();
    }

    public function orderLine()
    {
        return $this->hasOne(OrderLine::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return OrderLineStatusFactory::new();
    }
}

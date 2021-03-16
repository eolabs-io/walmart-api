<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models;

use EolabsIo\WalmartApi\Database\Factories\ReturnOrderLineFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Currency;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ChargeTotal;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnOrder;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ItemReturnSetting;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnOrderLineItem;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnTrackingDetail;

class ReturnOrderLine extends WalmartModel
{

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status_time' => 'datetime',
        'is_return_for_exception' => 'boolean',
        'return_expected_flag' => 'boolean',
        'is_fast_replacement' => 'boolean',
        'is_keep_it' => 'boolean',
        'last_item' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'return_order_line_number',
                    'sales_order_line_number',
                    'seller_order_id',
                    'return_reason',
                    'purchase_order_id',
                    'purchase_order_line_number',
                    'exception_item_type',
                    'is_return_for_exception',
                    'item_id',
                    'unit_price_id',
                    'cancellable_qty',
                    'quantity_id',
                    'return_expected_flag',
                    'is_fast_replacement',
                    'is_keep_it',
                    'last_item',
                    'refunded_qty',
                    'rechargeable_qty',
                    'refund_channel',
                    'status',
                    'status_time',
                    'current_delivery_status',
                    'current_refund_status',
                    'return_order_id',
                ];


    public function item()
    {
        return $this->belongsTo(ReturnOrderLineItem::class, 'item_id')->withDefault();
    }

    public function charges()
    {
        return $this->belongsToMany(OrderLineCharge::class);
    }

    public function unitPrice()
    {
        return $this->belongsTo(Currency::class, 'unit_price_id')->withDefault();
    }

    public function itemReturnSettings()
    {
        return $this->belongsToMany(ItemReturnSetting::class);
    }

    public function chargeTotals()
    {
        return $this->belongsToMany(ChargeTotal::class);
    }

    public function quantity()
    {
        return $this->belongsTo(Quantity::class)->withDefault();
    }

    public function returnTrackingDetails()
    {
        return $this->belongsToMany(ReturnTrackingDetail::class);
    }

    public function returnOrder()
    {
        return $this->belongsTo(ReturnOrder::class)->withDefault();
    }


    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ReturnOrderLineFactory::new();
    }
}

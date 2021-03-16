<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models;

use EolabsIo\WalmartApi\Database\Factories\OrderLineFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Order;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Refund;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderItem;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Fulfillment;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderLineQuantity;

class OrderLine extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'line_number',
                    'item_id',
                    'order_line_quantity_id',
                    'status_date',
                    'refund_id',
                    'original_carrier_method',
                    'reference_line_id',
                    'fulfillment_id',
                    'intent_to_cancel',
                    'config_id',
                    'seller_order_id',
                    'order_id',
                ];

    public function item()
    {
        return $this->belongsTo(OrderItem::class, 'item_id')->withDefault();
    }

    public function charges()
    {
        return $this->belongsToMany(Charge::class);
    }

    public function orderLineQuantity()
    {
        return $this->belongsTo(OrderLineQuantity::class)->withDefault();
    }

    public function orderLineStatuses()
    {
        return $this->hasMany(OrderLineStatus::class);
    }

    public function refund()
    {
        return $this->belongsTo(Refund::class)->withDefault();
    }

    public function fulfillment()
    {
        return $this->belongsTo(Fulfillment::class)->withDefault();
    }

    public function order()
    {
        return $this->belongsTo(Order::class)->withDefault();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return OrderLineFactory::new();
    }
}

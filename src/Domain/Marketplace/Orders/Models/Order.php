<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models;

use EolabsIo\WalmartApi\Database\Factories\OrderFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\ShipNode;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderLine;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderSummary;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\PickupPerson;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;

class Order extends WalmartModel
{

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_guest' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'purchase_order_id',
                    'customer_order_id',
                    'customer_email_id',
                    'order_date',
                    'buyer_id',
                    'mart',
                    'is_guest',
                    'shipping_info_id',
                    // 'payment_types',
                    'order_summary_id',
                    'ship_node_id',
                ];

    public function paymentTypes()
    {
        return $this->hasMany(PaymentType::class);
    }

    public function shippingInfo()
    {
        return $this->belongsTo(ShippingInfo::class)->withDefault();
    }

    public function orderLines()
    {
        return $this->hasMany(OrderLine::class);
    }

    public function orderSummary()
    {
        return $this->belongsTo(OrderSummary::class)->withDefault();
    }

    public function pickupPeople()
    {
        return $this->hasMany(PickupPerson::class);
    }

    public function shipNode()
    {
        return $this->belongsTo(ShipNode::class)->withDefault();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return OrderFactory::new();
    }
}

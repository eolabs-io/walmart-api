<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models;

use EolabsIo\WalmartApi\Database\Factories\ReturnOrderFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Name;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Currency;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnOrderLine;

class ReturnOrder extends WalmartModel
{

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'return_order_date' => 'datetime',
        'return_by_date' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'return_order_id',
                    'customer_email_id',
                    'return_type',
                    'replacement_customer_order_id',
                    'customer_name_id',
                    'customer_order_id',
                    'return_order_date',
                    'return_by_date',
                    'refund_mode',
                    'total_refund_amount_id',
                    'return_channel_id',
                ];


    public function customerName()
    {
        return $this->belongsTo(Name::class, 'customer_name_id')->withDefault();
    }

    public function totalRefundAmount()
    {
        return $this->belongsTo(Currency::class, 'total_refund_amount_id')->withDefault();
    }

    public function returnLineGroups()
    {
        return $this->hasMany(ReturnLineGroup::class);
    }

    public function returnOrderLines()
    {
        return $this->hasMany(ReturnOrderLine::class);
    }

    public function returnChannel()
    {
        return $this->belongsTo(ReturnChannel::class)->withDefault();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ReturnOrderFactory::new();
    }
}

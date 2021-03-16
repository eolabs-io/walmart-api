<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models;

use EolabsIo\WalmartApi\Database\Factories\RefundChargeFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Charge;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;

class RefundCharge extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'refund_reason',
                    'charge_id',
                    'refund_id',
                ];

    public function charge()
    {
        return $this->belongsTo(Charge::class)->withDefault();
    }

    public function refund()
    {
        return $this->belongsTo(Refund::class)->withDefault();
    }


    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return RefundChargeFactory::new();
    }
}

<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models;

use EolabsIo\WalmartApi\Database\Factories\RefundFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\RefundCharge;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;

class Refund extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'refund_id',
                    'refund_comments',
                ];

    public function refundCharges()
    {
        return $this->hasMany(RefundCharge::class);
    }


    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return RefundFactory::new();
    }
}

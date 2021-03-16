<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models;

use EolabsIo\WalmartApi\Database\Factories\ChargeFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Tax;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Currency;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;

class Charge extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'charge_type',
                    'charge_name',
                    'charge_amount_id',
                    'tax_id',
                ];

    public function chargeAmount()
    {
        return $this->belongsTo(Currency::class, 'charge_amount_id')->withDefault();
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class, 'tax_id')->withDefault();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ChargeFactory::new();
    }
}

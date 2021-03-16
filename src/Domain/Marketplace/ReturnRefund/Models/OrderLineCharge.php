<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models;

use EolabsIo\WalmartApi\Database\Factories\OrderLineChargeFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Currency;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ChargeTax;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\Reference;

class OrderLineCharge extends WalmartModel
{

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_discount' => 'boolean',
        'is_billable' => 'boolean',
    ];

    protected $hidden = ['pivot'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'charge_category',
                    'charge_name',
                    'charge_per_unit_id',
                    'is_discount',
                    'is_billable',
                    'excess_charge_id',
                ];

    public function chargePerUnit()
    {
        return $this->belongsTo(Currency::class, 'charge_per_unit_id')->withDefault();
    }

    public function taxes()
    {
        return $this->hasMany(ChargeTax::class);
    }

    public function excessCharge()
    {
        return $this->belongsTo(Currency::class, 'excess_charge_id')->withDefault();
    }

    public function references()
    {
        return $this->belongsToMany(Reference::class);
    }


    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return OrderLineChargeFactory::new();
    }
}

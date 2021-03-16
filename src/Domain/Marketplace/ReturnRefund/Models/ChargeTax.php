<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models;

use EolabsIo\WalmartApi\Database\Factories\ChargeTaxFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Currency;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\OrderLineCharge;

class ChargeTax extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'tax_name',
                    'excess_tax_id',
                    'tax_per_unit_id',
                    'order_line_charge_id',
                ];


    public function excessTax()
    {
        return $this->belongsTo(Currency::class, 'excess_tax_id')->withDefault();
    }

    public function taxPerUnit()
    {
        return $this->belongsTo(Currency::class, 'tax_per_unit_id')->withDefault();
    }

    public function orderLineCharge()
    {
        return $this->belongsTo(OrderLineCharge::class, 'order_line_charge_id');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ChargeTaxFactory::new();
    }
}

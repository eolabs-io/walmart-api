<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models;

use EolabsIo\WalmartApi\Database\Factories\ReferenceFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\OrderLineCharge;

class Reference extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'name',
                    'value',
                ];

    protected $hidden = ['pivot'];


    public function orderLineCharge()
    {
        return $this->belongsToMany(OrderLineCharge::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ReferenceFactory::new();
    }
}

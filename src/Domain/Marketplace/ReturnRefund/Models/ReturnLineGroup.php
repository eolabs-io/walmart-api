<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models;

use EolabsIo\WalmartApi\Database\Factories\ReturnLineGroupFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\Label;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnLine;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnOrder;

class ReturnLineGroup extends WalmartModel
{

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'return_expected_flag' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'group_no',
                    'return_expected_flag',
                    'return_order_id',
                ];


    public function returnLines()
    {
        return $this->hasMany(ReturnLine::class);
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class);
    }

    public function returnOrder()
    {
        return $this->belongsTo(ReturnOrder::class);
    }


    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ReturnLineGroupFactory::new();
    }
}

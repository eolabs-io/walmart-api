<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Name;
use EolabsIo\WalmartApi\Database\Factories\PickupPersonFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Order;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Phone;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;

class PickupPerson extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'name_id',
                    'phone_id',
                    'order_id',
                ];

    public function name()
    {
        return $this->belongsTo(Name::class)->withDefault();
    }

    public function phone()
    {
        return $this->belongsTo(Phone::class)->withDefault();
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
        return PickupPersonFactory::new();
    }
}

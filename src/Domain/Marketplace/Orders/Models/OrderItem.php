<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models;

use EolabsIo\WalmartApi\Database\Factories\OrderItemFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Weight;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;

class OrderItem extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'product_name',
                    'sku',
                    'image_url',
                    'weight_id'
                ];

    public function weight()
    {
        return $this->belongsTo(Weight::class)->withDefault();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return OrderItemFactory::new();
    }
}

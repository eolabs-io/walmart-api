<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Models;

use EolabsIo\WalmartApi\Database\Factories\ItemFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Price;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;

class Item extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'mart',
                    'sku',
                    'wpid',
                    'upc',
                    'gtin',
                    'product_name',
                    'shelf',
                    'product_type',
                    'published_status',
                    'lifecycle_status',
                ];

    public function price()
    {
        return $this->hasOne(Price::class)->withDefault();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ItemFactory::new();
    }
}

<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Models;

use EolabsIo\WalmartApi\Database\Factories\PriceFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Item;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;

class Price extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'currency',
                    'amount',
                    'item_id',
                ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return PriceFactory::new();
    }
}

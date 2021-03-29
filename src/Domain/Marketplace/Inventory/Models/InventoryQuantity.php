<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Inventory\Models;

use EolabsIo\WalmartApi\Database\Factories\InventoryQuantityFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Inventory\Models\Inventory;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;

class InventoryQuantity extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'unit',
                    'amount',
                ];


    public function quantity()
    {
        return $this->hasOne(Inventory::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return InventoryQuantityFactory::new();
    }
}

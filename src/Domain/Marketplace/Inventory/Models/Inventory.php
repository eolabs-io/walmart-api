<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Inventory\Models;

use EolabsIo\WalmartApi\Database\Factories\InventoryFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;
use EolabsIo\WalmartApi\Domain\Marketplace\Inventory\Models\InventoryQuantity;

class Inventory extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'sku',
                    'inventory_quantity_id',
                ];


    public function quantity()
    {
        return $this->belongsTo(InventoryQuantity::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return InventoryFactory::new();
    }
}

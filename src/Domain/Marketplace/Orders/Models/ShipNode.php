<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models;

use EolabsIo\WalmartApi\Database\Factories\ShipNodeFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\WalmartModel;

class ShipNode extends WalmartModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'type',
                    'name',
                    'ship_node_id'
                ];


    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ShipNodeFactory::new();
    }
}

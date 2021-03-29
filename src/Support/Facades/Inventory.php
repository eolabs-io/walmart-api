<?php

namespace EolabsIo\WalmartApi\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @see EolabsIo\WalmartApi\Domain\Marketplace\Inventory\Inventory;
 */
class Inventory extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'walmartapi-inventory';
    }
}

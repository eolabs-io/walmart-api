<?php

namespace EolabsIo\WalmartApi;

class Walmart
{

    /**
     * Indicates if Walmart migrations will be run.
     *
     * @var bool
     */
    public static $runsMigrations = true;


    /**
     * Configure Walmart MP to not register its migrations.
     *
     * @return static
     */
    public static function ignoreMigrations()
    {
        static::$runsMigrations = false;

        return new static;
    }
}

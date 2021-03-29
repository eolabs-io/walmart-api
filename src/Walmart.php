<?php

namespace EolabsIo\WalmartApi;

class Walmart
{

    /**
     * Indicates if Walmart migrations will be run.
     *
     * @var bool
     */
    public static $runsMigrations = false;


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

    /**
     * Configure Walmart MP to not register its migrations.
     *
     * @return static
     */
    public static function shouldRunMigrations()
    {
        static::$runsMigrations = true;

        return new static;
    }
}

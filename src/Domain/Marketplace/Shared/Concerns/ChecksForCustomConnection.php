<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns;

trait ChecksForCustomConnection
{
    /**
     * Initialize the trait
     *
     * @return void
     */
    protected function initializeChecksForCustomConnection()
    {
        $name = env('DB_WM_CONNECTION');
        $this->setConnection($name);
    }
}

<?php
namespace EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models\Concerns\RequestBodyable;

abstract class WalmartModel extends Model
{
    use HasFactory,
        RequestBodyable;

    /**
     * Get the current connection name for the model.
     *
     * @return string|null
     */
    public function getConnectionName()
    {
        return config('walmart.database.connection') ?? $this->connection;
    }
}

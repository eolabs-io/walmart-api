<?php
namespace EolabsIo\WalmartApi\Domain\Marketplace\Shared\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\ChecksForCustomConnection;

abstract class WalmartModel extends Model
{
    use ChecksForCustomConnection,
        HasFactory;
}

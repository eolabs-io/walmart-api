<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Taxonomy;

class PersistedTaxonomyEvent
{
    use Dispatchable, SerializesModels;

    /** @var EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Taxonomy */
    public $taxonomy;

    public function __construct(Taxonomy $taxonomy)
    {
        $this->taxonomy = $taxonomy;
    }
}

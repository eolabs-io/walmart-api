<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Items;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Taxonomy;

class TaxonomyTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Taxonomy::class;
    }
}

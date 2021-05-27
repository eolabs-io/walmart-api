<?php

namespace EolabsIo\WalmartApi\Tests\Unit\Items;

use EolabsIo\WalmartApi\Tests\Unit\BaseModelTest;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Image;

class ImageTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return Image::class;
    }
}

<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Image;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAttachAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class AttachImagesAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'images';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Image);

        $this->model->images()->updateOrCreate($values);
    }
}

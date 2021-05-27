<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAttachAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class AttachCategoriesAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'categories';
    }

    protected function createItem($list)
    {
        $values = ['name' => $list];

        $this->model->categories()->updateOrCreate($values);
    }
}

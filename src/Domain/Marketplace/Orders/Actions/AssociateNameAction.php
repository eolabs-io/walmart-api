<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Name;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;

class AssociateNameAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'name';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Name);
        $name = $this->model->name->fill($values);
        $name->save();

        $this->model->name()->associate($name);
    }
}

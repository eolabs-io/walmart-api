<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Weight;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;

class AssociateWeightAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'weight';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Weight);
        $weight = $this->model->weight->fill($values);
        $weight->save();

        $this->model->weight()->associate($weight);
    }
}

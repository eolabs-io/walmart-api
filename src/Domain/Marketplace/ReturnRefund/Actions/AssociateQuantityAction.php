<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\Quantity;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class AssociateQuantityAction extends BaseAssociateAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'quantity';
    }

    protected function createItem($list)
    {
        $quantity = $this->model->quantity;
        $values = $this->getFormatedAttributes($list, new Quantity);
        $quantity->fill($values);

        $quantity->save();
        $this->model->quantity()->associate($quantity);
    }
}

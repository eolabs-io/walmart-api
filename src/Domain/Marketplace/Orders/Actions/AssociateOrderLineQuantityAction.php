<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderLineQuantity;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;

class AssociateOrderLineQuantityAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'orderLineQuantity';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new OrderLineQuantity);
        $orderLineQuantity = $this->model->orderLineQuantity->fill($values);
        $orderLineQuantity->save();

        $this->model->orderLineQuantity()->associate($orderLineQuantity);
    }
}

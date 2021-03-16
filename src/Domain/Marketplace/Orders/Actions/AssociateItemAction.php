<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderItem;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AssociateWeightAction;

class AssociateItemAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'item';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new OrderItem);
        $orderItem = $this->model->item->fill($values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($orderItem);
        }

        $orderItem->push();

        $this->model->item()->associate($orderItem);
    }

    protected function associateActions(): array
    {
        return [
            AssociateWeightAction::class,
        ];
    }
}

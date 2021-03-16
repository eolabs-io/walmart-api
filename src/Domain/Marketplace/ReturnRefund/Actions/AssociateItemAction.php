<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnOrderLineItem;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions\AssociateItemWeightAction;

class AssociateItemAction extends BaseAssociateAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'item';
    }

    protected function createItem($list)
    {
        $item = $this->model->item;
        $values = $this->getFormatedAttributes($list, new ReturnOrderLineItem);
        $item->fill($values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($item);
        }

        $item->save();
        $this->model->item()->associate($item);
    }

    protected function associateActions(): array
    {
        return [
            AssociateItemWeightAction::class,
        ];
    }
}

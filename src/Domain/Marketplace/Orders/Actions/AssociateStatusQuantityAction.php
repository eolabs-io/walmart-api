<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\StatusQuantity;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;

class AssociateStatusQuantityAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'statusQuantity';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new StatusQuantity);
        // $statusQuantity = $this->model->statusQuantity->fill($values);
        // $statusQuantity->save();

        $statusQuantity = StatusQuantity::firstOrCreate($values, $values);

        $this->model->statusQuantity()->associate($statusQuantity);
    }
}

<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Currency;

class AssociateTotalAmountAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'totalAmount';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Currency);
        $totalAmount = $this->model->totalAmount->fill($values);
        $totalAmount->save();

        $this->model->totalAmount()->associate($totalAmount);
    }
}

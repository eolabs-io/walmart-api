<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Currency;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;

class AssociateChargeAmountAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'chargeAmount';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Currency);
        $chargeAmount = $this->model->chargeAmount->fill($values);
        $chargeAmount->save();

        $this->model->chargeAmount()->associate($chargeAmount);
    }
}

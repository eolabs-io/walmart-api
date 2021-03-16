<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Currency;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;

class AssociateTaxAmountAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'taxAmount';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Currency);
        $taxAmount = $this->model->taxAmount->fill($values);
        $taxAmount->save();

        $this->model->taxAmount()->associate($taxAmount);
    }
}

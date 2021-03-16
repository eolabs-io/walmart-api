<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class AssociateUnitPriceAction extends BaseAssociateAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'unitPrice';
    }

    protected function createItem($list)
    {
        $unitPrice = $this->model->unitPrice;
        $values = [
            'currency' => data_get($list, 'currencyUnit'),
            'amount' => data_get($list, 'currencyAmount'),
        ];

        $unitPrice->fill($values)->save();
        $this->model->unitPrice()->associate($unitPrice);
    }
}

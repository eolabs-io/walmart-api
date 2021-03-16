<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class AssociateChargeTotalValueAction extends BaseAssociateAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'value';
    }

    protected function createItem($list)
    {
        $value = $this->model->value;
        $value->currency = data_get($list, 'currencyUnit');
        $value->amount = data_get($list, 'currencyAmount');

        $value->save();

        $this->model->value()->associate($value);
    }
}

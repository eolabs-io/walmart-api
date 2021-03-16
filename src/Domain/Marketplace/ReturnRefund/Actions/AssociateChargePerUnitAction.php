<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class AssociateChargePerUnitAction extends BaseAssociateAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'chargePerUnit';
    }

    protected function createItem($list)
    {
        $chargePerUnit = $this->model->chargePerUnit;
        $chargePerUnit->currency = data_get($list, 'currencyUnit');
        $chargePerUnit->amount = data_get($list, 'currencyAmount');

        $chargePerUnit->save();

        $this->model->chargePerUnit()->associate($chargePerUnit);
    }
}

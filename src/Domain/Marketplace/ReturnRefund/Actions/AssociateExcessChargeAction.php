<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class AssociateExcessChargeAction extends BaseAssociateAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'excessCharge';
    }

    protected function createItem($list)
    {
        $excessCharge = $this->model->excessCharge;
        $excessCharge->currency = data_get($list, 'currencyUnit');
        $excessCharge->amount = data_get($list, 'currencyAmount');

        $excessCharge->save();

        $this->model->excessCharge()->associate($excessCharge);
    }
}

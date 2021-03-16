<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class AssociateExcessTaxAction extends BaseAssociateAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'excessTax';
    }

    protected function createItem($list)
    {
        $excessTax = $this->model->excessTax;
        $excessTax->currency = data_get($list, 'currencyUnit');
        $excessTax->amount = data_get($list, 'currencyAmount');

        $excessTax->save();

        $this->model->excessTax()->associate($excessTax);
    }
}

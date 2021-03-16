<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class AssociateTaxPerUnitAction extends BaseAssociateAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'taxPerUnit';
    }

    protected function createItem($list)
    {
        $taxPerUnit = $this->model->taxPerUnit;
        $taxPerUnit->currency = data_get($list, 'currencyUnit');
        $taxPerUnit->amount = data_get($list, 'currencyAmount');

        $taxPerUnit->save();

        $this->model->taxPerUnit()->associate($taxPerUnit);
    }
}

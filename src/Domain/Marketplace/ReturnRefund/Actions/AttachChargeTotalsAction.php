<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ChargeTotal;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAttachAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions\AssociateChargeTotalValueAction;

class AttachChargeTotalsAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'chargeTotals';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ChargeTotal);
        $chargeTotal = new ChargeTotal($values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($chargeTotal);
        }

        $chargeTotal->push();

        $this->model->chargeTotals()->attach($chargeTotal);
    }

    protected function associateActions(): array
    {
        return [
            AssociateChargeTotalValueAction::class,
        ];
    }
}

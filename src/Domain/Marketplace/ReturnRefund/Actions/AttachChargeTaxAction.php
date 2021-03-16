<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ChargeTax;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAttachAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions\AssociateExcessTaxAction;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions\AssociateTaxPerUnitAction;

class AttachChargeTaxAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'tax';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ChargeTax);
        $values['order_line_charge_id'] = $this->model->id;
        $chargeTax = new ChargeTax($values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($chargeTax);
        }

        $chargeTax->push();
    }

    protected function associateActions(): array
    {
        return [
            AssociateExcessTaxAction::class,
            AssociateTaxPerUnitAction::class,
        ];
    }
}

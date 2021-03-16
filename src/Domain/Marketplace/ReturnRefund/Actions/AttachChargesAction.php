<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAttachAction;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\OrderLineCharge;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions\AttachChargeTaxAction;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions\AttachReferencesAction;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions\AssociateExcessChargeAction;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions\AssociateChargePerUnitAction;

class AttachChargesAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'charges';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new OrderLineCharge);
        $orderLineCharge = new OrderLineCharge($values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($orderLineCharge);
        }

        $orderLineCharge->push();

        foreach ($this->attachActions() as $attachAction) {
            (new $attachAction($list))->execute($orderLineCharge);
        }

        $this->model->charges()->attach($orderLineCharge);
    }

    protected function associateActions(): array
    {
        return [
            AssociateChargePerUnitAction::class,
            AssociateExcessChargeAction::class,
        ];
    }

    protected function attachActions(): array
    {
        return [
            AttachReferencesAction::class,
            AttachChargeTaxAction::class,
        ];
    }
}

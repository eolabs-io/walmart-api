<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAttachAction;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnOrderLine;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions\AttachChargesAction;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions\AssociateQuantityAction;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions\AssociateUnitPriceAction;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions\AttachChargeTotalsAction;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions\AttachItemReturnSettingsAction;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions\AttachReturnTrackingDetailsAction;

class AttachReturnOrderLinesAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'returnOrderLines';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ReturnOrderLine);
        $values['return_order_id'] = $this->model->id;
        $returnOrderLine = new ReturnOrderLine($values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($returnOrderLine);
        }

        $returnOrderLine->push();

        foreach ($this->attachActions() as $attachAction) {
            (new $attachAction($list))->execute($returnOrderLine);
        }
    }

    protected function associateActions(): array
    {
        return [
            AssociateItemAction::class,
            AssociateUnitPriceAction::class,
            AssociateQuantityAction::class,
        ];
    }

    protected function attachActions(): array
    {
        return [
            AttachChargesAction::class,
            AttachItemReturnSettingsAction::class,
            AttachChargeTotalsAction::class,
            AttachReturnTrackingDetailsAction::class,
        ];
    }
}

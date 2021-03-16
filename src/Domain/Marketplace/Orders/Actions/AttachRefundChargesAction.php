<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\RefundCharge;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAttachAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AssociateChargeAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class AttachRefundChargesAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'refundCharges.refundCharge';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new RefundCharge);
        $values['refund_id'] = $this->model->id;
        $refundCharge = RefundCharge::firstOrNew($values, $values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($refundCharge);
        }

        $refundCharge->push();
    }

    protected function associateActions(): array
    {
        return [
            AssociateChargeAction::class,
        ];
    }
}

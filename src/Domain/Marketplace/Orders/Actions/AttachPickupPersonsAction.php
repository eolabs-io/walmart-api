<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\PickupPerson;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\RefundCharge;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAttachAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AssociateNameAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AssociatePhoneAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AssociateChargeAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class AttachPickupPersonsAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'pickupPersons';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new PickupPerson);
        $values['order_id'] = $this->model->id;
        $refundCharge = PickupPerson::firstOrNew($values, $values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($refundCharge);
        }

        $refundCharge->push();
    }

    protected function associateActions(): array
    {
        return [
            AssociateNameAction::class,
            AssociatePhoneAction::class,
        ];
    }
}

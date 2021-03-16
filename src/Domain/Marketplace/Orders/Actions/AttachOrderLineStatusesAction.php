<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderLineStatus;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAttachAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AssociateTrackingInfoAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AssociateStatusQuantityAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AssociateReturnCenterAddressAction;

class AttachOrderLineStatusesAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'orderLineStatuses.orderLineStatus';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new OrderLineStatus);
        $values['order_line_id'] = $this->model->id;
        $orderLineStatus = OrderLineStatus::firstOrNew($values, $values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($orderLineStatus);
        }

        $orderLineStatus->push();
    }

    protected function associateActions(): array
    {
        return [
            AssociateStatusQuantityAction::class,
            AssociateTrackingInfoAction::class,
            AssociateReturnCenterAddressAction::class,
        ];
    }
}

<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use Illuminate\Support\Carbon;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderLine;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAttachAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AssociateItemAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AttachChargesAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AssociateRefundAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AssociateFulfillmentAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AssociateOrderLineQuantityAction;

class AttachOrderLinesAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'orderLines.orderLine';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new OrderLine);
        $values['status_date'] = Carbon::createFromTimestampMs($values['status_date']);
        $values['order_id'] = $this->model->id;
        $orderLine = OrderLine::firstOrNew($values, $values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($orderLine);
        }

        $orderLine->push();

        foreach ($this->attachActions() as $attachAction) {
            (new $attachAction($list))->execute($orderLine);
        }
    }

    protected function associateActions(): array
    {
        return [
            AssociateItemAction::class,
            AssociateOrderLineQuantityAction::class,
            AssociateRefundAction::class,
            AssociateFulfillmentAction::class,
        ];
    }

    protected function attachActions(): array
    {
        return [
            AttachChargesAction::class,
            AttachOrderLineStatusesAction::class,
        ];
    }
}

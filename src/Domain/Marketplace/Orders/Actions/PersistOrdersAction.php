<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Order;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\ShippingInfo;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BasePersistAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AttachOrderLinesAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AssociateShipNodeAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AttachPickupPersonsAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AssociateOrderSummaryAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AssociateShippingInfoAction;

class PersistOrdersAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'list.elements.order';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new Order);
        $values['order_date'] = Carbon::createFromTimestampMs($values['order_date']);
        $attributes = ['purchase_order_id' => data_get($list, 'purchaseOrderId')];


        $order = Order::firstOrNew($attributes, $values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($order);
        }

        $order->push();

        foreach ($this->attachActions() as $associateActions) {
            (new $associateActions($list))->execute($order);
        }

        return $order;
    }

    protected function associateActions(): array
    {
        return [
            // AttachPaymentTypeAction::class,
            AssociateShippingInfoAction::class,
            AssociateOrderSummaryAction::class,
            AssociateShipNodeAction::class,
        ];
    }

    protected function attachActions(): array
    {
        return [
            AttachOrderLinesAction::class,
            AttachPickupPersonsAction::class,
        ];
    }
}

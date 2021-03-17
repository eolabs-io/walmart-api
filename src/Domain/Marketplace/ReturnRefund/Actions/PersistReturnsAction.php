<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnOrder;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BasePersistAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions\AssociateCustomerNameAction;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions\AssociateReturnChannelAction;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions\AttachReturnLineGroupsAction;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions\AssociateTotalRefundAmountAction;

class PersistReturnsAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'returnOrders';
    }

    protected function createItem($list): Model
    {
        $attributes = ['return_order_id' => data_get($list, 'returnOrderId')];

        // If ReturnOrder exist Return and dont create
        if ($returnOrder = ReturnOrder::where($attributes)->first()) {
            return $returnOrder;
        }

        $values = $this->getFormatedAttributes($list, new ReturnOrder);
        $returnOrder = new ReturnOrder($values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($returnOrder);
        }

        $returnOrder->push();

        foreach ($this->attachActions() as $attachAction) {
            (new $attachAction($list))->execute($returnOrder);
        }

        return $returnOrder;
    }

    protected function associateActions(): array
    {
        return [
            AssociateCustomerNameAction::class,
            AssociateTotalRefundAmountAction::class,
            AssociateReturnChannelAction::class,
        ];
    }

    protected function attachActions(): array
    {
        return [
            AttachReturnLineGroupsAction::class,
            AttachReturnOrderLinesAction::class,
        ];
    }
}

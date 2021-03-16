<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderSummary;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AssociateTotalAmountAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AttachOrderSubTotalsAction;

class AssociateOrderSummaryAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'orderSummary';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new OrderSummary);
        $orderSummary = $this->model->orderSummary->fill($values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($orderSummary);
        }

        $orderSummary->push();

        foreach ($this->attachActions() as $attachAction) {
            (new $attachAction($list))->execute($orderSummary);
        }

        $this->model->orderSummary()->associate($orderSummary);
    }

    protected function associateActions(): array
    {
        return [
            AssociateTotalAmountAction::class,
        ];
    }

    protected function attachActions(): array
    {
        return [
            AttachOrderSubTotalsAction::class,
        ];
    }
}

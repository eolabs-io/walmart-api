<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\OrderSubTotal;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAttachAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AssociateTotalAmountAction;

class AttachOrderSubTotalsAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'orderSubTotals';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new OrderSubTotal);
        $values['order_summary_id'] = $this->model->id;
        $orderSubTotal = OrderSubTotal::firstOrNew($values, $values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($orderSubTotal);
        }

        $orderSubTotal->push();
    }

    protected function associateActions(): array
    {
        return [
            AssociateTotalAmountAction::class,
        ];
    }
}

<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class AssociateTotalRefundAmountAction extends BaseAssociateAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'totalRefundAmount';
    }

    protected function createItem($list)
    {
        $totalRefundAmount = $this->model->totalRefundAmount;
        $totalRefundAmount->currency = data_get($list, 'currencyUnit');
        $totalRefundAmount->amount = data_get($list, 'currencyAmount');

        $totalRefundAmount->save();

        $this->model->totalRefundAmount()->associate($totalRefundAmount);
    }
}

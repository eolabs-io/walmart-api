<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Refund;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AttachRefundChargesAction;

class AssociateRefundAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'refund';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Refund);
        $refund = $this->model->refund->fill($values);
        $refund->save();

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($refund);
        }

        $this->model->refund()->associate($refund);
    }

    protected function associateActions(): array
    {
        return [
            AttachRefundChargesAction::class,
        ];
    }
}

<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Charge;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAttachAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AssociateTaxAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AssociateChargeAmountAction;

class AttachChargesAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'charges.charge';
    }

    public function beforeCreateFromList()
    {
        foreach ($this->model->charges as $charge) {
            $this->model->charges()->detach($charge->id);
            $chargeAmount = $charge->chargeAmount;
            $tax = $charge->tax;
            $taxAmount = $tax->taxAmount;

            $charge->delete();
            $chargeAmount->delete();
            $tax->delete();
            $taxAmount->delete();
        }
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Charge);
        $charge = new Charge($values, $values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($charge);
        }

        $charge->push();

        $this->model->charges()->attach($charge);
    }

    protected function associateActions(): array
    {
        return [
            AssociateChargeAmountAction::class,
            AssociateTaxAction::class,
        ];
    }
}

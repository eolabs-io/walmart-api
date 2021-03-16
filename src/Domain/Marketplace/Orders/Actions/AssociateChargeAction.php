<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Charge;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AssociateTaxAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AssociateChargeAmountAction;

class AssociateChargeAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'charge';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Charge);
        $charge = $this->model->charge->fill($values);
        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($charge);
        }

        $charge->push();

        $this->model->charge()->associate($charge);
    }

    protected function associateActions(): array
    {
        return [
            AssociateChargeAmountAction::class,
            AssociateTaxAction::class,
        ];
    }
}

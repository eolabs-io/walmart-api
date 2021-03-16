<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Tax;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AssociateTaxAmountAction;

class AssociateTaxAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'tax';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Tax);
        $tax = $this->model->tax->fill($values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($tax);
        }

        $tax->push();

        $this->model->tax()->associate($tax);
    }

    protected function associateActions(): array
    {
        return [
            AssociateTaxAmountAction::class,
        ];
    }
}

<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Name;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class AssociateCustomerNameAction extends BaseAssociateAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'customerName';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Name);
        $name = Name::firstOrCreate($values, $values);

        $this->model->customerName()->associate($name);
    }
}

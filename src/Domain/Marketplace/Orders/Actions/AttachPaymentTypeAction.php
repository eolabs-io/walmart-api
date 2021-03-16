<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAttachAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class AttachPaymentTypeAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'paymentTypes';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new PaymentType);

        $this->model->subcategories()->updateOrCreate($values, $values);
    }
}

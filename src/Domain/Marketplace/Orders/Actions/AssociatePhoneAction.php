<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Phone;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;

class AssociatePhoneAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'phone';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Phone);
        $phone = $this->model->phone->fill($values);
        $phone->save();

        $this->model->phone()->associate($phone);
    }
}

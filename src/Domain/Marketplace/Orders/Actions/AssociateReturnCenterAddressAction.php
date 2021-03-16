<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\ReturnCenterAddress;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;

class AssociateReturnCenterAddressAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'returnCenterAddress';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ReturnCenterAddress);
        $returnCenterAddress = $this->model->returnCenterAddress->fill($values);
        $returnCenterAddress->save();

        $this->model->returnCenterAddress()->associate($returnCenterAddress);
    }
}

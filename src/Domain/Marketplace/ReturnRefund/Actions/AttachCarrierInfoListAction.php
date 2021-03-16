<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAttachAction;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\CarrierInfoList;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class AttachCarrierInfoListAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'carrierInfoList';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new CarrierInfoList);
        $carrierInfoList = CarrierInfoList::create($values, $values);

        $this->model->carrierInfoLists()->attach($carrierInfoList);
    }
}

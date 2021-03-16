<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class AssociateItemWeightAction extends BaseAssociateAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'itemWeight';
    }

    protected function createItem($list)
    {
        $itemWeight = $this->model->itemWeight;

        $values = [
            'value' => data_get($list, 'measurementValue'),
            'unit' => data_get($list, 'unitOfMeasure')
        ];

        $itemWeight->fill($values)->save();

        $this->model->itemWeight()->associate($itemWeight);
    }
}

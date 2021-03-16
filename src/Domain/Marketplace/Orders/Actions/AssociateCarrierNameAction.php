<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\CarrierName;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;

class AssociateCarrierNameAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'carrierName';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new CarrierName);
        $carrierName = CarrierName::firstOrCreate($values, $values);

        $this->model->carrierName()->associate($carrierName);
    }
}

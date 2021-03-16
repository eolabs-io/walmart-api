<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use Illuminate\Support\Carbon;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\ShippingInfo;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AssociatePostalAddressAction;

class AssociateShippingInfoAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'shippingInfo';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ShippingInfo);
        $values['estimated_delivery_date'] = Carbon::createFromTimestampMs($values['estimated_delivery_date']);
        $values['estimated_ship_date'] = Carbon::createFromTimestampMs($values['estimated_ship_date']);
        $shippingInfo = $this->model->shippingInfo->fill($values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($shippingInfo);
        }

        $shippingInfo->push();

        $this->model->shippingInfo()->associate($shippingInfo);
    }

    protected function associateActions(): array
    {
        return [
            AssociatePostalAddressAction::class,
        ];
    }
}

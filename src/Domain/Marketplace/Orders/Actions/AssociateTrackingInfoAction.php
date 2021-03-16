<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use Illuminate\Support\Carbon;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\TrackingInfo;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions\AssociateCarrierNameAction;

class AssociateTrackingInfoAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'trackingInfo';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new TrackingInfo);
        $values['ship_date_time'] = Carbon::createFromTimestampMs($values['ship_date_time']);
        $trackingInfo = $this->model->trackingInfo->fill($values);
        $trackingInfo->save();

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($trackingInfo);
        }

        $this->model->trackingInfo()->associate($trackingInfo);
    }

    protected function associateActions(): array
    {
        return [
            AssociateCarrierNameAction::class,
        ];
    }
}

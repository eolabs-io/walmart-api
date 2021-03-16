<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use Illuminate\Support\Carbon;
use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\Fulfillment;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;

class AssociateFulfillmentAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'fulfillment';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Fulfillment);
        $values['pick_up_date_time'] = Carbon::createFromTimestampMs($values['pick_up_date_time']);
        $fulfillment = $this->model->fulfillment->fill($values);
        $fulfillment->save();

        $this->model->fulfillment()->associate($fulfillment);
    }
}

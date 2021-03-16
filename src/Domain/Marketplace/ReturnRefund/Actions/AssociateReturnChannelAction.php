<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnChannel;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class AssociateReturnChannelAction extends BaseAssociateAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'returnChannel';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ReturnChannel);
        $returnChannel = ReturnChannel::firstOrCreate($values, $values);

        $this->model->returnChannel()->associate($returnChannel);
    }
}

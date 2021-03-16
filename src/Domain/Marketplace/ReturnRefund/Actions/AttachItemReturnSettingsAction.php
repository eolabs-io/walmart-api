<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAttachAction;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ItemReturnSetting;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class AttachItemReturnSettingsAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'itemReturnSettings';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ItemReturnSetting);
        $itemReturnSetting = ItemReturnSetting::create($values);

        $this->model->itemReturnSettings()->attach($itemReturnSetting);
    }
}

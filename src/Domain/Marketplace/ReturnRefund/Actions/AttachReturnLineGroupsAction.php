<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAttachAction;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnLineGroup;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions\AttachLabelsAction;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions\AttachReturnLinesAction;

class AttachReturnLineGroupsAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'returnLineGroups';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ReturnLineGroup);
        $values['return_order_id'] = $this->model->id;
        $returnLineGroup = new ReturnLineGroup($values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($returnLineGroup);
        }

        $returnLineGroup->push();

        foreach ($this->attachActions() as $attachAction) {
            (new $attachAction($list))->execute($returnLineGroup);
        }
    }

    protected function attachActions(): array
    {
        return [
            AttachReturnLinesAction::class,
            AttachLabelsAction::class,
        ];
    }
}

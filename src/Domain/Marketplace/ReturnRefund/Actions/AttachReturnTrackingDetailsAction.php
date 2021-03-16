<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAttachAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnTrackingDetail;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions\AttachReferencesAction;

class AttachReturnTrackingDetailsAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'returnTrackingDetail';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ReturnTrackingDetail);
        $returnTrackingDetail = ReturnTrackingDetail::create($values);

        foreach ($this->attachActions() as $attachAction) {
            (new $attachAction($list))->execute($returnTrackingDetail);
        }

        $this->model->returnTrackingDetails()->attach($returnTrackingDetail);
    }

    protected function attachActions(): array
    {
        return [
            AttachReferencesAction::class,
        ];
    }
}

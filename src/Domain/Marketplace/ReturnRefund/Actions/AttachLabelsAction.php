<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\Label;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAttachAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions\AttachCarrierInfoListAction;

class AttachLabelsAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'labels';
    }

    protected function createItem($list)
    {
        $values['label_image_url'] = data_get($list, 'labelImageURL');
        $label = Label::create($values);

        foreach ($this->attachActions() as $attachAction) {
            (new $attachAction($list))->execute($label);
        }

        $this->model->labels()->attach($label);
    }

    protected function attachActions(): array
    {
        return [
            AttachCarrierInfoListAction::class,
        ];
    }
}

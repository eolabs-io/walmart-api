<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Variant;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Actions\AttachVariantDataAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Actions\AttachVariantMetaAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class AssociateVariantAction extends BaseAssociateAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'variants';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Variant);
        $variant = $this->model->variant;
        $variant->fill($values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($variant);
        }

        $variant->save();

        foreach ($this->attachActions() as $attachAction) {
            (new $attachAction($list))->execute($variant);
        }

        $this->model->variant()->associate($variant);

        return $variant;
    }

    protected function associateActions(): array
    {
        return [];
    }

    protected function attachActions(): array
    {
        return [
            AttachVariantMetaAction::class,
            AttachVariantDataAction::class,
        ];
    }
}

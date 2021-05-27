<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\VariantData;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAttachAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Actions\AttachVariantValuesAction;

class AttachVariantDataAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'variantData';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new VariantData);
        $values['variant_id'] = $this->model->id;

        $variantData = VariantData::updateOrCreate($values);

        foreach ($this->attachActions() as $attachAction) {
            (new $attachAction($list))->execute($variantData);
        }

        return $variantData;
    }

    protected function attachActions(): array
    {
        return [
            AttachVariantValuesAction::class,
        ];
    }
}

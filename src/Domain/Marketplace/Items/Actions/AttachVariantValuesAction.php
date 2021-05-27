<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\VariantValue;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAttachAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class AttachVariantValuesAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'variantValues';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new VariantValue);
        $values['variant_data_id'] = $this->model->id;

        $this->model->variantValues()->updateOrCreate($values);
    }
}

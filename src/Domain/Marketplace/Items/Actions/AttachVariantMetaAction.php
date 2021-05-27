<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\VariantMeta;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAttachAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class AttachVariantMetaAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'variantMeta';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new VariantMeta);

        $this->model->variantMeta()->updateOrCreate($values);
    }
}

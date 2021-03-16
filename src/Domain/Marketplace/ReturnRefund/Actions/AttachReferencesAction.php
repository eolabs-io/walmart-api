<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\Reference;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAttachAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class AttachReferencesAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'references';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Reference);
        $reference = Reference::create($values);

        $this->model->references()->attach($reference);
    }
}

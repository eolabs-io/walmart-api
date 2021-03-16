<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\ReturnRefund\Models\ReturnLine;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAttachAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class AttachReturnLinesAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'returnLines';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ReturnLine);
        $values['return_line_group_id'] = $this->model->id;
        $returnLine = ReturnLine::create($values);
    }
}

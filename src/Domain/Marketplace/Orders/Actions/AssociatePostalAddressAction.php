<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\PostalAddress;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;

class AssociatePostalAddressAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'postalAddress';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new PostalAddress);
        $postalAddress = PostalAddress::firstOrCreate($values, $values);

        $this->model->postalAddress()->associate($postalAddress);
    }
}

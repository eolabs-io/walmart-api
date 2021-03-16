<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Orders\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Orders\Models\ShipNode;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;

class AssociateShipNodeAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'shipNode';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new ShipNode);
        $values['ship_node_id'] = data_get($list, 'id');
        $shipNode = ShipNode::firstOrCreate($values, $values);

        $this->model->shipNode()->associate($shipNode);
    }
}

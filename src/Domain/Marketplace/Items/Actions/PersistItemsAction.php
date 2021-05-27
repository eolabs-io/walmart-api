<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Item;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Events\PersistedItemsEvent;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BasePersistAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Actions\AssociatePriceAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class PersistItemsAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'ItemResponse';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new Item);
        $attributes = ['sku' => data_get($list, 'sku'),];

        $item = Item::firstOrNew($attributes, $values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($item);
        }

        $item->push();

        return $item;
    }

    protected function associateActions(): array
    {
        return [
            AssociatePriceAction::class,
        ];
    }

    public function getPersistedEvent()
    {
        return PersistedItemsEvent::class;
    }
}

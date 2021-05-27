<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\ItemVariant;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Actions\AttachImagesAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BasePersistAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Actions\AssociatePriceAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Actions\AssociatePropertyAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class PersistItemSearchAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'items';
    }

    protected function createItem($list): Model
    {
        $identifiers = $this->getIdentifiers();
        $values = array_merge(
            $this->getFormatedAttributes($list, new ItemVariant),
            $identifiers,
        );
        $attributes = ['item_id' => data_get($list, 'itemId'),];

        $itemVariant = ItemVariant::firstOrNew($attributes, $values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($itemVariant);
        }

        $itemVariant->push();

        foreach ($this->attachActions() as $attachAction) {
            (new $attachAction($list))->execute($itemVariant);
        }

        return $itemVariant;
    }

    protected function associateActions(): array
    {
        return [
            AssociatePriceAction::class,
            AssociatePropertyAction::class,
        ];
    }

    protected function attachActions(): array
    {
        return [
            AttachImagesAction::class,
        ];
    }

    public function getIdentifiers(): array
    {
        $originalList = $this->getOriginalList();

        return [
            'upc' => data_get($originalList, 'query_parameters.upc'),
            'gtin' => data_get($originalList, 'query_parameters.gtin'),
        ];
    }
}

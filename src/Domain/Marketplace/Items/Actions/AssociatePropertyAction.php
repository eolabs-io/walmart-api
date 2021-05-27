<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Actions;

use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Property;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BaseAssociateAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Actions\AssociateVariantAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Actions\AttachCategoriesAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class AssociatePropertyAction extends BaseAssociateAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'properties';
    }

    protected function createItem($list)
    {
        $values = [
            'variant_items_num' => data_get($list, 'variant_items_num'),
            'num_reviews' => data_get($list, 'num_reviews'),
            'next_day_eligible' => data_get($list, 'next_day_eligible'),
        ];

        $property = $this->model->property;
        $property->fill($values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($property);
        }

        $property->save();

        foreach ($this->attachActions() as $attachAction) {
            (new $attachAction($list))->execute($property);
        }

        $this->model->property()->associate($property);

        return $property;
    }

    protected function associateActions(): array
    {
        return [
            AssociateVariantAction::class,
        ];
    }

    protected function attachActions(): array
    {
        return [
            AttachCategoriesAction::class,
        ];
    }
}

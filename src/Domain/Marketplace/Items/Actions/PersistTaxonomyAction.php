<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Models\Taxonomy;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions\BasePersistAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Events\PersistedTaxonomyEvent;
use EolabsIo\WalmartApi\Domain\Marketplace\Items\Actions\AttachSubcategoryAction;
use EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns\FormatsModelAttributes;

class PersistTaxonomyAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'payload';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new Taxonomy());
        $attributes = ['category' => data_get($list, 'category'),];

        $taxonomy = Taxonomy::updateOrCreate($attributes, $values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($taxonomy);
        }

        $taxonomy->push();

        return $taxonomy;
    }

    protected function associateActions(): array
    {
        return [
            AttachSubcategoryAction::class,
        ];
    }

    public function getPersistedEvent()
    {
        return PersistedTaxonomyEvent::class;
    }
}

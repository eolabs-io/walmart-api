<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Concerns;

trait ItemsQueryable
{
    /** @var array */
    private $itemsQueryableParameters = [
        'sku' => null,
        'offset' => '0',
        'limit' => '20',
        'lifecycleStatus' => null,
        'publishedStatus' => null,
    ];


    public function withSku($sku = null): self
    {
        $this->itemsQueryableParameters['sku'] = $sku;

        return $this;
    }

    public function withOffset($offset): self
    {
        $this->itemsQueryableParameters['offset'] = $offset;

        return $this;
    }

    public function withLimit($limit): self
    {
        $this->itemsQueryableParameters['limit'] = $limit;

        return $this;
    }

    public function withLifecycleStatusActive(): self
    {
        $this->itemsQueryableParameters['lifecycleStatus'] = 'ACTIVE';

        return $this;
    }

    public function withLifecycleStatusArchived(): self
    {
        $this->itemsQueryableParameters['lifecycleStatus'] = 'ARCHIVED';

        return $this;
    }

    public function withLifecycleStatusRetired(): self
    {
        $this->itemsQueryableParameters['lifecycleStatus'] = 'RETIRED';

        return $this;
    }

    public function withPublishedStatusPublished(): self
    {
        $this->itemsQueryableParameters['publishedStatus'] = 'PUBLISHED';

        return $this;
    }

    public function withPublishedStatusUnpublished(): self
    {
        $this->itemsQueryableParameters['publishedStatus'] = 'UNPUBLISHED';

        return $this;
    }

    public function getItemsQueryParameters(): array
    {
        return $this->itemsQueryableParameters;
    }
}

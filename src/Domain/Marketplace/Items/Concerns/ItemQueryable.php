<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Concerns;

trait ItemQueryable
{

    /** @var string */
    private $productId;

    /** @var string */
    private $productIdType;



    public function withProductId($id = null): self
    {
        $this->productId = $id;

        return $this;
    }

    public function getProductId(): ?string
    {
        return $this->productId;
    }

    public function hasProductId(): bool
    {
        return filled($this->productId);
    }

    public function clearProductId(): self
    {
        $this->productId = null;

        return $this;
    }

    public function withProductIdTypeSKU(): self
    {
        $this->productIdType = 'SKU';

        return $this;
    }

    public function withProductIdTypeGTIN(): self
    {
        $this->productIdType = 'GTIN';

        return $this;
    }

    public function withProductIdTypeUPC(): self
    {
        $this->productIdType = 'UPC';

        return $this;
    }

    public function withProductIdTypeISBN(): self
    {
        $this->productIdType = 'ISBN';

        return $this;
    }

    public function withProductIdTypeEAN(): self
    {
        $this->productIdType = 'EAN';

        return $this;
    }

    public function withProductIdTypeITEMID(): self
    {
        $this->productIdType = 'ITEM_ID';

        return $this;
    }

    public function getItemQueryParameters(): array
    {
        if ($this->hasProductId()) {
            return ['productIdType' => $this->productIdType];
        }

        return [];
    }
}

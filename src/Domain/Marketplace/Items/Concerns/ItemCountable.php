<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Items\Concerns;

trait ItemCountable
{

    /** @var array */
    private $countStatus = [
        'status' => 'ALL'
    ];


    public function withCountAll(): self
    {
        $this->countStatus['status'] = 'ALL';

        return $this;
    }

    public function withCountPublished(): self
    {
        $this->countStatus['status'] = 'PUBLISHED';

        return $this;
    }

    public function withCountUnpublished(): self
    {
        $this->countStatus['status'] = 'UNPUBLISHED';

        return $this;
    }

    public function getItemCountParameters(): array
    {
        return $this->countStatus;
    }
}

<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Shared\Concerns;

use Illuminate\Support\Collection;

trait NextCursorable
{
    /** @var string */
    private $nextCursor;


    public function checkForNextCursor(Collection $results): self
    {
        $cursor = $results->get('nextCursor');
        $this->setNextCursor($cursor);

        return $this;
    }

    public function clearNextCursor(): self
    {
        $this->setNextCursor();

        return $this;
    }

    public function getNextCursor(): ?string
    {
        return $this->nextCursor;
    }

    public function setNextCursor(string $nextCursor = null): self
    {
        $this->nextCursor = $nextCursor;

        return $this;
    }

    public function hasNextCursor(): bool
    {
        return filled($this->getNextCursor());
    }

    public function getNextCursorParameter(): array
    {
        return ['nextCursor' => $this->getNextCursor()];
    }
}

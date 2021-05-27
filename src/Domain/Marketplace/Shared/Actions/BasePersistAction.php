<?php

namespace EolabsIo\WalmartApi\Domain\Marketplace\Shared\Actions;

use Illuminate\Database\Eloquent\Model;

abstract class BasePersistAction
{

    /** @var array */
    private $list;

    private $originalList;

    public function __construct($list)
    {
        $this->originalList = $list;

        $key = $this->getKey();
        $this->list = data_get($list, $key, []);
    }

    abstract public function getKey(): string;

    public function execute()
    {
        $this->createFromList();
    }

    private function createFromList()
    {
        foreach ($this->list as $value) {
            $item = $this->createItem($value);

            $this->firePersistedActionEvent($item);
        }
    }

    abstract protected function createItem($list): Model;

    private function firePersistedActionEvent(Model $item)
    {
        $event = $this->getPersistedEvent();
        if (is_null($event)) {
            return;
        }

        $event::dispatch($item);
    }

    public function getPersistedEvent()
    {
        return null;
    }

    public function getOriginalList()
    {
        return $this->originalList;
    }
}

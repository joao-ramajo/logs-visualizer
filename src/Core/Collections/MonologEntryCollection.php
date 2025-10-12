<?php

namespace Ramajo\Core\Collections;

use Countable;
use Ramajo\Core\Entities\MonologEntry;
use Ramajo\Core\Interfaces\EntryCollectionInterface;
use Ramajo\Core\Interfaces\LogEntryInterface;

class MonologEntryCollection implements EntryCollectionInterface, Countable
{
    public function __construct(
        private array $entries = []
    ) {}

    public function add(LogEntryInterface $entry): void
    {
        $this->entries[] = $entry;
    }

    public function all(): array
    {
        return $this->entries;
    }

    public function count(): int
    {
        return count($this->entries);
    }

    public function get(int $index): MonologEntry
    {
        return $this->entries[$index];
    }

    public function toJson(): string
    {
        return json_encode(array_map(fn($entry) => json_decode($entry->toJson(), true), $this->entries));
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->entries);
    }
}

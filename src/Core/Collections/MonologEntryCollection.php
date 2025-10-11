<?php

namespace Ramajo\Core\Collections;

use Ramajo\Core\Interfaces\EntryCollectionInterface;
use Ramajo\Core\Interfaces\LogEntryInterface;

class MonologEntryCollection implements EntryCollectionInterface
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
}

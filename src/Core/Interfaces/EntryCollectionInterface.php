<?php

namespace Ramajo\Core\Interfaces;

use IteratorAggregate;

interface EntryCollectionInterface extends IteratorAggregate
{
    public function add(LogEntryInterface $entry): void;

    public function all(): array;

    public function get(int $index): LogEntryInterface;

    public function toJson(): string;
}

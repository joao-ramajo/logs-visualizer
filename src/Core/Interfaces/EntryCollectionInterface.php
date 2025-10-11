<?php

namespace Ramajo\Core\Interfaces;

interface EntryCollectionInterface
{
    public function add(LogEntryInterface $entry): void;
    public function all(): array;
    
    public function get(int $index): ?LogEntryInterface;
}

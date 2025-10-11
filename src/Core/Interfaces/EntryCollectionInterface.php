<?php

namespace Ramajo\Core\Interfaces;

interface EntryCollectionInterface
{
    public function add(LogEntryInterface $entry): void;
}

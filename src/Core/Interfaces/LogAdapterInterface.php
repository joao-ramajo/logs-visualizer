<?php

namespace Ramajo\Core\Interfaces;

interface LogAdapterInterface
{
    public function parse(array $lines): EntryCollectionInterface;

    public function toJson(EntryCollectionInterface $collection): string;
}

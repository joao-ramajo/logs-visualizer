<?php

namespace Ramajo\Infra\Adapters;

use Ramajo\Core\Collections\MonologEntryCollection;
use Ramajo\Core\Entities\MonologEntry;
use Ramajo\Core\Interfaces\LogAdapterInterface;

class MonologAdapter implements LogAdapterInterface
{
    public function parse(array $lines): MonologEntryCollection
    {
        $collection = new MonologEntryCollection();

        foreach ($lines as $line) {
            if (preg_match('/^\[(?<timestamp>.*?)\]\s+(?<level>\w+):\s+(?<message>.*)$/', $line, $matches)) {
                $collection->add(new MonologEntry(
                    timestamp: $matches['timestamp'],
                    level: $matches['level'],
                    message: $matches['message'],
                ));
            }
        }

        return $collection;
    }
}
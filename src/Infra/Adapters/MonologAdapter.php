<?php

namespace Ramajo\Infra\Adapters;

use DateTimeImmutable;
use Ramajo\Core\Collections\MonologEntryCollection;
use Ramajo\Core\Entities\MonologEntry;
use Ramajo\Core\Interfaces\EntryCollectionInterface;
use Ramajo\Core\Interfaces\LogAdapterInterface;
use Ramajo\Core\Interfaces\LogEntryInterface;

class MonologAdapter implements LogAdapterInterface
{
    public function parse(array $lines): MonologEntryCollection
    {
        $collection = new MonologEntryCollection();

        foreach ($lines as $line) {
            if (preg_match('/^\[(?<timestamp>\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\]\s+(?<channel>[\w-]+)\.(?<level>\w+):\s+(?<message>.*?)(?:\s+(?<context>\{.*\}))?$/s', trim($line), $matches)) {
                $collection->add(new MonologEntry(
                    timestamp: new DateTimeImmutable($matches['timestamp']),
                    channel: $matches['channel'],
                    level: $matches['level'],
                    message: $matches['message'],
                    context: $matches['context'] ?? null
                ));
            }
        }

        return $collection;
    }

    public function toJson(EntryCollectionInterface $entries): string
    {
        $json = '';

        foreach($entries as $entry){
            $json .= $entry->toJson();
        }

        return $json;
    }
}
<?php

require_once __DIR__ . '/bootstrap.php';

interface LogFileReaderInterface
{
    public function read(string $file): array;
}

class FileReader implements LogFileReaderInterface
{
    public function read(string $file): array
    {
        if (!file_exists($file)) {
            throw new Exception('Arquivo ' . $file . ' não encontrado.');
        }

        $handle = fopen($file, 'r');

        $lines = [];
        while (($line = fgets($handle)) !== false) {
            $lines[] = $line;
        }

        fclose($handle);

        return $lines;
    }
}

interface LogEntryInterface
{

}

interface EntryCollectionInterface
{
    public function add(LogEntryInterface $entry): void;
}

class MonologEntryCollection implements EntryCollectionInterface
{
    public function __construct(
        private array $entries = []
    ) {}

    public function add(LogEntryInterface $entry): void
    {
        $this->entries[] = $entry;
    }
}
class MonologEntry implements LogEntryInterface
{
    public function __construct(
        public string $timestamp,
        public string $level,
        public string $message
    ) {}
}

interface LogAdapterInterface
{
    public function parse(array $lines): EntryCollectionInterface;
}

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

$reader = new FileReader();

$res = $reader->read('src/arquivo.log');

$adapter = new MonologAdapter();

var_dump($adapter->parse($res));

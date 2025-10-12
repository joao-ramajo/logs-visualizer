<?php

namespace Ramajo\Infra\Strategies;

use Ramajo\Core\Entities\File;
use Ramajo\Core\Interfaces\EntryCollectionInterface;
use Ramajo\Core\Interfaces\LogReaderInterface;
use Ramajo\Core\Interfaces\LogAdapterInterface;
use Ramajo\Infra\Readers\FileReader;
use Ramajo\Infra\Adapters\MonologAdapter;

class MonologStrategy implements \Ramajo\Core\Interfaces\LogStrategyInterface
{
    public function __construct(
        private ?LogReaderInterface $reader = null,
        private ?LogAdapterInterface $adapter = null
    ) {
        $this->reader ??= new FileReader();
        $this->adapter ??= new MonologAdapter();
    }

    public function process(File $file, int $lines = 10): EntryCollectionInterface
    {
        $content = $this->reader->tail($file, $lines);
        return $this->adapter->parse($content);
    }

    public function toJson(EntryCollectionInterface $entries): string
    {
        return $this->adapter->toJson($entries);
    }
}

<?php

namespace Ramajo\App;

use Ramajo\Core\Entities\File;
use Ramajo\Core\Interfaces\EntryCollectionInterface;
use Ramajo\Core\Interfaces\LogStrategyInterface;

class LogVisualizer
{
    private File $file;

    public function __construct(
        string $path,
        private LogStrategyInterface $strategy
    )
    {
        $this->file = new File($path);
    }

    public function tail(int $lines = 10): EntryCollectionInterface
    {
        return $this->strategy->process($this->file, $lines);
    }

    public function toJson(EntryCollectionInterface $entries): string
    {
        return $this->strategy->toJson($entries);
    }
}
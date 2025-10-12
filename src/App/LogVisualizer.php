<?php

namespace Ramajo\App;

use Ramajo\Core\Entities\File;
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

    public function tail(int $lines = 10)
    {
        return $this->strategy->process($this->file, $lines);
    }
}
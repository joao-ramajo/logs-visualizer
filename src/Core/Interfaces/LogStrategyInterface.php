<?php

namespace Ramajo\Core\Interfaces;

use Ramajo\Core\Entities\File;
use Ramajo\Core\Interfaces\EntryCollectionInterface;

interface LogStrategyInterface
{
    public function process(File $file, int $lines = 10): EntryCollectionInterface;
}

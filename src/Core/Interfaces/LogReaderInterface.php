<?php

namespace Ramajo\Core\Interfaces;

use Ramajo\Core\Entities\File;

interface LogReaderInterface
{
    public function read(File $file): array;

    public function tail(string $file, int $lines): array;
}

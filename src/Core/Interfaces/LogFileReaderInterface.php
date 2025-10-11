<?php

namespace Ramajo\Core\Interfaces;

interface LogFileReaderInterface
{
    public function read(string $file): array;
}

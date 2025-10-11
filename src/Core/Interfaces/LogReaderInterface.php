<?php

namespace Ramajo\Core\Interfaces;

interface LogReaderInterface
{
    public function read(string $file): array;
}

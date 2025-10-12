<?php

namespace Ramajo\Core\Interfaces;

interface LogReaderInterface
{
    public function read(string $file): array;

    public function tail(string $file, int $lines): array;
}

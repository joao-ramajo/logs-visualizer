<?php

namespace Ramajo\Infra\Readers;

use Ramajo\Core\Exceptions\LogFileNotFoundException;
use Ramajo\Core\Interfaces\LogReaderInterface;

class FileReader implements LogReaderInterface
{
    public function read(string $file): array
    {
        if (!file_exists($file)) {
            throw new LogFileNotFoundException($file);
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

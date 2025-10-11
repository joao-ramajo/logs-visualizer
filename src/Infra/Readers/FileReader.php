<?php

namespace Ramajo\Infra\Readers;

use Ramajo\Core\Interfaces\LogReaderInterface;

class FileReader implements LogReaderInterface
{
    public function read(string $file): array
    {
        if (!file_exists($file)) {
            throw new \Exception('Arquivo ' . $file . ' não encontrado.');
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

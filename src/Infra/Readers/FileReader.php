<?php

namespace Ramajo\Infra\Readers;

use Ramajo\Core\Interfaces\LogFileReaderInterface;

class FileReader implements LogFileReaderInterface
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
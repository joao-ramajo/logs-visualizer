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

    public function tail(string $file, int $lines = 10): array
    {
        if (!file_exists($file)) {
            throw new LogFileNotFoundException($file);
        }

        $handle = fopen($file, 'r');
        if ($handle === false) {
            throw new \RuntimeException("Não foi possível abrir o arquivo: $file");
        }

        $content = [];
        $position = -1;
        $buffer = '';
        $count = 0;

        fseek($handle, $position, SEEK_END);

        while ($count < $lines && fseek($handle, $position, SEEK_END) !== -1) {
            $char = fgetc($handle);

            if ($char === "\n") {
                if (trim($buffer) !== '') {
                    $count++;
                    $content[] = strrev($buffer) . "\n";
                }
                $buffer = '';
            } else {
                $buffer .= $char;
            }

            $position--;
        }

        if (trim($buffer) !== '' && $count < $lines) {
            $content[] = strrev($buffer) . "\n" . $content;
        }

        fclose($handle);

        return $content;
    }
}

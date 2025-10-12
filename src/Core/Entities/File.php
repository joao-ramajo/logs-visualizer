<?php

namespace Ramajo\Core\Entities;

use Ramajo\Core\Exceptions\LogFileNotFoundException;

class File
{
    public function __construct(
        private string $file
    ){
        $this->validateFile($file);
    }

    public function validateFile(string $file): void
    {
        if(!file_exists($file)) {
            throw new LogFileNotFoundException($this->file);
        }
    }
}
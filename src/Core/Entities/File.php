<?php

namespace Ramajo\Core\Entities;

use Ramajo\Core\Exceptions\LogFileNotFoundException;

/**
 * Representa um arquivo e valida sua existência.
 */
class File
{
    /**
     * @param string $file Caminho do arquivo desejado
     */
    public function __construct(
        private readonly string $file
    ) {
        $this->validateFile($file);
    }

    public function __toString(): string
    {
        return $this->file;
    }

    /**
     * Valida se o arquivo existe
     *
     * @param string $file Caminho do arquivo
     *
     * @throws LogFileNotFoundException Lança uma excessão ao não encontrar o arquivo
     *
     * @return void
     */
    public function validateFile(string $file): void
    {
        if (!file_exists($file)) {
            throw new LogFileNotFoundException($this->file);
        }
    }
}

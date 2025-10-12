<?php

namespace Ramajo\Core\Interfaces;

use Ramajo\Core\Entities\File;

/**
 * Interface para leitores de arquivos de log.
 *
 * Define métodos que todo leitor de log deve implementar,
 * permitindo leitura completa ou parcial (últimas linhas) de arquivos.
 */
interface LogReaderInterface
{
    /**
     * Lê todas as linhas de um arquivo de log.
     *
     * @param File $file Instância representando o arquivo de log.
     *
     * @return string[] Array contendo todas as linhas do arquivo.
     */
    public function read(File $file): array;

    /**
     * Retorna as últimas linhas de um arquivo de log.
     *
     * @param File $file Instância representando o arquivo de log.
     * @param int $lines Quantidade de linhas a serem retornadas do final do arquivo.
     *
     * @return string[] Array contendo as últimas linhas do arquivo.
     */
    public function tail(File $file, int $lines): array;
}

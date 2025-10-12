<?php

namespace Ramajo\Infra\Readers;

use Ramajo\Core\Entities\File;
use Ramajo\Core\Interfaces\LogReaderInterface;

/**
 * Classe responsável pela leitura de arquivos de log.
 *
 * Implementa LogReaderInterface e fornece métodos para:
 * - Ler todo o conteúdo de um arquivo
 * - Obter as últimas linhas de um arquivo (tail)
 */
class FileReader implements LogReaderInterface
{
    /**
     * Lê todas as linhas de um arquivo.
     *
     * @param File $file Arquivo a ser lido
     *
     * @return string[] Array contendo todas as linhas do arquivo
     *
     * @throws \RuntimeException Se o arquivo não puder ser aberto
     */
    public function read(File $file): array
    {
        $handle = fopen($file, 'r');

        $lines = [];
        while (($line = fgets($handle)) !== false) {
            $lines[] = $line;
        }

        fclose($handle);

        return $lines;
    }

    /**
     * Retorna as últimas $lines linhas de um arquivo, ignorando linhas vazias.
     *
     * @param File $file Arquivo a ser lido
     * @param int $lines Quantidade de linhas a serem retornadas
     *
     * @return string[] Array contendo as últimas linhas do arquivo
     *
     * @throws \RuntimeException Se o arquivo não puder ser aberto
     */
    public function tail(File $file, int $lines = 10): array
    {
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
            $content[] = strrev($buffer) . "\n";
        }

        fclose($handle);

        return $content;
    }
}

<?php

namespace Ramajo\Core\Interfaces;

use Ramajo\Core\Entities\File;
use Ramajo\Core\Interfaces\EntryCollectionInterface;

/**
 * Interface para estratégias de processamento de logs.
 *
 * Define métodos que toda estratégia de log deve implementar, 
 * permitindo processar arquivos e gerar saídas estruturadas (como JSON).
 */
interface LogStrategyInterface
{
    /**
     * Processa um arquivo de log e retorna uma coleção de entradas.
     *
     * @param File $file Instância representando o arquivo de log.
     * @param int $lines Número de linhas a serem processadas do final do arquivo.
     *
     * @return EntryCollectionInterface Coleção de entradas de log processadas.
     */
    public function process(File $file, int $lines = 10): EntryCollectionInterface;

    /**
     * Converte uma coleção de entradas de log em JSON.
     *
     * @param EntryCollectionInterface $entries Coleção de entradas de log.
     *
     * @return string JSON representando as entradas da coleção.
     */
    public function toJson(EntryCollectionInterface $entries): string;
}

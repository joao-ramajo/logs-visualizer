<?php

namespace Ramajo\Core\Interfaces;

/**
 * Interace para os Adapters
 *
 * Define os métodos básicos que todo adapter deve conter para processar as informações dos arquivos.
 */
interface LogAdapterInterface
{
    /**
     * Realiza o parse inicial de um conjunto de linhas de log.
     *
     * @param string[] $lines Array de linhas de um arquivo de log.
     *
     * @return EntryCollectionInterface<LogEntryInterface> Coleção de entradas de log estruturadas.
     */
    public function parse(array $lines): EntryCollectionInterface;

    /**
     * Converte uma coleção de entradas de log em JSON.
     *
     * @param EntryCollectionInterface<LogEntryInterface> $collection Coleção de entradas de log.
     *
     * @return string JSON representando todas as entradas da coleção.
     */
    public function toJson(EntryCollectionInterface $collection): string;
}

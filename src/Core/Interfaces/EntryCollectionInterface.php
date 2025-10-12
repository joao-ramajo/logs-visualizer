<?php

namespace Ramajo\Core\Interfaces;

use IteratorAggregate;

/**
 * Interface para coleções de entradas de log.
 *
 * Define os métodos necessários para manipular, acessar e exportar
 * uma coleção de logs de forma consistente.
 *
 * @extends IteratorAggregate<int, LogEntryInterface>
 */
interface EntryCollectionInterface extends IteratorAggregate
{
    /**
     * Adiciona uma entrada de log à coleção.
     *
     * @param LogEntryInterface $entry A entrada de log a ser adicionada.
     */
    public function add(LogEntryInterface $entry): void;

    /**
     * Retorna todas as entradas da coleção em um array.
     *
     * @return array<LogEntryInterface>
     */
    public function all(): array;

    /**
     * Retorna a entrada de log no índice especificado.
     *
     * @param int $index Índice da entrada.
     *
     * @return LogEntryInterface
     *
     * @throws \OutOfBoundsException Se o índice não existir.
     */
    public function get(int $index): LogEntryInterface;

    /**
     * Retorna a coleção inteira em formato JSON.
     *
     * @return string JSON representando todas as entradas da coleção.
     */
    public function toJson(): string;
}

<?php

namespace Ramajo\Core\Collections;

use Ramajo\Core\Entities\MonologEntry;
use Ramajo\Core\Exceptions\LogEntryNotFoundException;
use Ramajo\Core\Interfaces\EntryCollectionInterface;
use Ramajo\Core\Interfaces\LogEntryInterface;
use Countable;

/**
 * Coleção imutável de entradas de log Monolog.
 *
 * Agrupa múltiplas entradas de log permitindo operações de busca,
 * filtragem e exportação. Implementa Countable e IteratorAggregate
 * para integração nativa com PHP.
 *
 */
class MonologEntryCollection implements EntryCollectionInterface, Countable
{
    /**
     * @param array<LogEntryInterface> $entries
     */
    public function __construct(
        private array $entries = []
    ) {}

    /**
     * Adiciona uma entidade para coleção
     *
     * @param LogEntryInterface $entry Instância de uma entidade de log
     */
    public function add(LogEntryInterface $entry): void
    {
        $this->entries[] = $entry;
    }

    /**
     * Retorna um array com todas as entidades da coleção
     *
     * @return array<LogEntryInterface> Cada item representa uma entidade
     */
    public function all(): array
    {
        return $this->entries;
    }

    /**
     * Retorna o total de entidades dentro da coleção
     *
     * @return int Quantidade total de entidades
     */
    public function count(): int
    {
        return count($this->entries);
    }

    /**
     * Busca e retorna uma entidade a partir de um índice
     *
     * @param int $index Índice de busca
     *
     * @return LogEntryInterface Entidade de Log
     *
     * @throws LogEntryNotFoundException Se não encontrar lança uma excessão
     */
    public function get(int $index): LogEntryInterface
    {
        if (!array_key_exists($index, $this->entries)) {
            throw new LogEntryNotFoundException($index);
        }

        return $this->entries[$index];
    }

    /**
     * Retorna uma string JSON válida a partir da coleção
     *
     * @return string Conjunto JSON de informações sobre as entidades
     */
    public function toJson(): string
    {
        return json_encode(array_map(fn($entry) => json_decode($entry->toJson(), true), $this->entries));
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->entries);
    }
}

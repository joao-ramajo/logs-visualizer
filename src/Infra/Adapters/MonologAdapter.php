<?php

namespace Ramajo\Infra\Adapters;

use Ramajo\Core\Collections\MonologEntryCollection;
use Ramajo\Core\Entities\MonologEntry;
use Ramajo\Core\Interfaces\EntryCollectionInterface;
use Ramajo\Core\Interfaces\LogAdapterInterface;
use DateTimeImmutable;

/**
 * Adapter para o padrão Monolog.
 *
 * Esta classe implementa a interface LogAdapterInterface e permite processar
 * logs gerados pelo Monolog (usado em frameworks como Laravel).
 *
 * Ela é responsável por:
 *  - Fazer o parse de linhas de log em uma coleção de entidades (MonologEntryCollection)
 *  - Transformar a coleção de logs em JSON para consumo externo
 */
class MonologAdapter implements LogAdapterInterface
{
    /**
     * Processa um conjunto de linhas de log e retorna uma coleção estruturada.
     *
     * Faz o parse das linhas de log seguindo o padrão Monolog e cria
     * instâncias de MonologEntry armazenadas em MonologEntryCollection.
     *
     * @param string[] $lines Array de linhas de log do arquivo
     *
     * @return MonologEntryCollection Coleção de entidades MonologEntry
     */
    public function parse(array $lines): MonologEntryCollection
    {
        $collection = new MonologEntryCollection();

        foreach ($lines as $line) {
            if (preg_match('/^\[(?<timestamp>\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\]\s+(?<channel>[\w-]+)\.(?<level>\w+):\s+(?<message>.*?)(?:\s+(?<context>\{.*\}))?$/s', trim($line), $matches)) {
                $collection->add(new MonologEntry(
                    timestamp: new DateTimeImmutable($matches['timestamp']),
                    channel: $matches['channel'],
                    level: $matches['level'],
                    message: $matches['message'],
                    context: $matches['context'] ?? null
                ));
            }
        }

        return $collection;
    }

    /**
     * Converte uma coleção de entradas de log em uma string JSON.
     *
     * Itera sobre cada entrada da coleção e concatena seu JSON individual
     * em uma única string. Cada entrada deve implementar o método toJson().
     *
     * @param EntryCollectionInterface $entries Coleção de logs a ser convertida
     *
     * @return string String JSON contendo todas as entradas da coleção
     */
    public function toJson(EntryCollectionInterface $entries): string
    {
        $array = array_map(fn($entry) => json_decode($entry->toJson(), true), $entries->all());
        return json_encode($array);
    }
}

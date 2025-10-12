<?php

namespace Ramajo\Infra\Strategies;

use Ramajo\Core\Entities\File;
use Ramajo\Core\Interfaces\EntryCollectionInterface;
use Ramajo\Core\Interfaces\LogAdapterInterface;
use Ramajo\Core\Interfaces\LogReaderInterface;
use Ramajo\Core\Interfaces\LogStrategyInterface;
use Ramajo\Infra\Adapters\MonologAdapter;
use Ramajo\Infra\Readers\FileReader;

/**
 * Estratégia para processamento de logs no formato Monolog.
 *
 * Esta classe implementa o padrão Strategy (LogStrategyInterface) e fornece
 * métodos para processar arquivos de log Monolog e convertê-los em JSON.
 *
 * Possui integração com um leitor de arquivos (LogReaderInterface) e um
 * adaptador de logs (LogAdapterInterface), podendo ser sobrescrito via
 * injeção de dependência.
 */
class MonologStrategy implements LogStrategyInterface
{
    /**
     * Inicializa a estratégia Monolog com leitor e adaptador opcionais.
     *
     * @param LogReaderInterface|null $reader Leitor de arquivos (padrão: FileReader)
     * @param LogAdapterInterface|null $adapter Adaptador de logs (padrão: MonologAdapter)
     */
    public function __construct(
        private ?LogReaderInterface $reader = null,
        private ?LogAdapterInterface $adapter = null
    ) {
        $this->reader ??= new FileReader();
        $this->adapter ??= new MonologAdapter();
    }

    /**
     * Processa um arquivo e retorna uma coleção de entradas de log.
     *
     * @param File $file Arquivo de log a ser processado
     * @param int $lines Número de últimas linhas a serem processadas (padrão: 10)
     *
     * @return EntryCollectionInterface Coleção de entradas de log processadas
     */
    public function process(File $file, int $lines = 10): EntryCollectionInterface
    {
        $content = $this->reader->tail($file, $lines);
        return $this->adapter->parse($content);
    }

    /**
     * Converte uma coleção de entradas de log em JSON.
     *
     * @param EntryCollectionInterface $entries Coleção de entradas de log
     *
     * @return string JSON representando as entradas de log
     */
    public function toJson(EntryCollectionInterface $entries): string
    {
        return $this->adapter->toJson($entries);
    }
}

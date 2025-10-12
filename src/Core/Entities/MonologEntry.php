<?php

namespace Ramajo\Core\Entities;

use Ramajo\Core\Interfaces\LogEntryInterface;
use DateTimeImmutable;

/**
 * Entidade que representa uma informação(linha) de um arquivo de logs
 */
class MonologEntry implements LogEntryInterface
{
    /**
     * MonologEntry constructor.
     *
     * @param DateTimeImmutable $timestamp Data e hora do log
     * @param string $channel Canal do log
     * @param string $level Nível do log
     * @param string $message Conteúdo principal do log
     * @param string|null $context Contexto do log ou stack traces
     */
    public function __construct(
        public DateTimeImmutable $timestamp,
        public string $channel,
        public string $level,
        public string $message,
        public ?string $context = null
    ) {}

    /**
     * Retorna a data e hora do log
     *
     * @return DateTimeImmutable
     */
    public function getTimestamp(): DateTimeImmutable
    {
        return $this->timestamp;
    }

    /**
     * Retorna o nível do LOG
     *
     * @return string
     */
    public function getLevel(): string
    {
        return $this->level;
    }

    /**
     * Retorna o canal do LOG
     *
     * @return string
     */
    public function getChannel(): string
    {
        return $this->channel;
    }

    /**
     * Retorna o conteúdo do LOG
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Retorna o contexto do log ou null se não houver.
     *
     * @return string|null
     */
    public function getContext(): ?string
    {
        return $this->context;
    }

    /**
     * Retorna o conteúdo do log como array associativo.
     *
     * @return array<string, mixed> Cada chave representa uma propriedade do log
     */
    public function toArray(): array
    {
        return [
            'timestamp' => $this->timestamp,
            'channel' => $this->channel,
            'level' => $this->level,
            'message' => $this->message,
            'context' => $this->context
        ];
    }

    /**
     * Retorna o conteúdo do log como string JSON.
     *
     * @return string JSON representando a entidade de log
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}

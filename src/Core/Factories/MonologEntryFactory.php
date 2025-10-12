<?php

namespace Ramajo\Core\Factories;

use Ramajo\Core\Entities\MonologEntry;
use DateTimeImmutable;

/**
 * Factory para criação de instâncias de MonologEntry.
 *
 * Permite criar entradas de log com valores padrão ou personalizados,
 * útil para testes, mocks ou criação rápida de logs em memória.
 */
class MonologEntryFactory
{
    /**
     * Cria uma nova instância de MonologEntry.
     *
     * @param string|null $message Conteúdo principal do log. Padrão: 'Default message'.
     * @param string|null $level Nível do log. Padrão: 'INFO'.
     * @param string|null $channel Canal do log. Padrão: 'Local'.
     * @param string|null $context Contexto adicional ou stack trace. Padrão: null.
     * @param DateTimeImmutable|null $timestamp Data e hora do log. Se null, será usado o momento atual.
     *
     * @return MonologEntry Nova instância da entidade de log.
     */
    public static function make(
        ?string $message = 'Default message',
        ?string $level = 'INFO',
        ?string $channel = 'Local',
        ?string $context = null,
        ?DateTimeImmutable $timestamp = null
    ): MonologEntry {
        return new MonologEntry(
            timestamp: $timestamp ?? new DateTimeImmutable(),
            channel: $channel,
            level: $level,
            message: $message,
            context: $context,
        );
    }
}

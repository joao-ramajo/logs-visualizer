<?php

namespace Ramajo\Core\Interfaces;

/**
 * Interface que define os métodos de uma entrada de log.
 *
 * Serve como contrato para todas as entidades que representam uma linha ou registro de log.
 */
interface LogEntryInterface
{
    /**
     * Retorna a representação da entrada de log em formato JSON.
     *
     * @return string JSON representando os dados da entrada de log.
     */
    public function toJson(): string;
}

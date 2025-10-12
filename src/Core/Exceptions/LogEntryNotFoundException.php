<?php

namespace Ramajo\Core\Exceptions;

class LogEntryNotFoundException extends \Exception
{
    public function __construct(int $index, $code = 0, ?\Throwable $previous = null)
    {
        $message = 'Nenhuma entidade de log encontrada no índice ' . $index . ' nesta coleção.';
        parent::__construct($message, $code, $previous);
    }
}

<?php

namespace Ramajo\Core\Exceptions;

class LogFileNotFoundException extends \Exception
{
    public function __construct(string $file = '', $code = 0, ?\Throwable $previous = null)
    {
        $message = $file ? "Arquivo $file não encontrado." : 'Arquivo de log não encontrado.';
        parent::__construct($message, $code, $previous);
    }
}

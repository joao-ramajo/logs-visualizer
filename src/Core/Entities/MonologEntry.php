<?php

namespace Ramajo\Core\Entities;

use Ramajo\Core\Interfaces\LogEntryInterface;

class MonologEntry implements LogEntryInterface
{
    public function __construct(
        public string $timestamp,
        public string $level,
        public string $message
    ) {}
}
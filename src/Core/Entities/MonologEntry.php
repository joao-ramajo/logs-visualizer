<?php

namespace Ramajo\Core\Entities;

use DateTimeImmutable;
use Ramajo\Core\Interfaces\LogEntryInterface;

class MonologEntry implements LogEntryInterface
{
    public function __construct(
        public DateTimeImmutable $timestamp,
        public string $level,
        public string $message
    ) {}

    public function getLevel(): string
    {
        return $this->level;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getTimestamp(): DateTimeImmutable
    {
        return $this->timestamp;
    }
}
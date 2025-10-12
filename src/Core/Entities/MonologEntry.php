<?php

namespace Ramajo\Core\Entities;

use Ramajo\Core\Interfaces\LogEntryInterface;
use DateTimeImmutable;

class MonologEntry implements LogEntryInterface
{
    public function __construct(
        public DateTimeImmutable $timestamp,
        public string $channel,
        public string $level,
        public string $message,
        public ?string $context = null
    ) {}

    public function getTimestamp(): DateTimeImmutable
    {
        return $this->timestamp;
    }

    public function getLevel(): string
    {
        return $this->level;
    }

    public function getChannel(): string
    {
        return $this->channel;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getContext(): ?string
    {
        return $this->context;
    }

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

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}

<?php

namespace Ramajo\Core\Factories;

use Ramajo\Core\Entities\MonologEntry;
use DateTimeImmutable;

class MonologEntryFactory
{
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

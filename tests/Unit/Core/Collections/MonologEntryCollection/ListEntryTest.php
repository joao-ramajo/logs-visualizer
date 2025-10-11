<?php

use Ramajo\Core\Collections\MonologEntryCollection;
use Ramajo\Core\Entities\MonologEntry;

test('lista corretamente uma série de entidades', function () {
    $collection = new MonologEntryCollection();

    expect($collection->count(''))->toBe(0);

    $collection->add(new MonologEntry(
        timestamp: '2025-10-11 14:23:01',
        level: 'ERROR',
        message: 'Unexpected token in JSON payload at line 23'
    ));

    $collection->add(new MonologEntry(
        timestamp: '2025-10-11 14:23:15',
        level: 'INFO',
        message: 'Application terminated gracefully.'
    ));

    $collection->add(new MonologEntry(
        timestamp: '2025-10-11 14:22:01',
        level: 'INFO',
        message: 'Application started successfully.'
    ));

    $collection->add(new MonologEntry(
        timestamp: '2025-10-11 14:22:02',
        level: 'DEBUG',
        message: 'Loaded configuration file: /config/app.php'
    ));

    $collection->add(new MonologEntry(
        timestamp: '2025-10-11 14:22:05',
        level: 'WARNING',
        message: 'Cache directory not found, using default.'
    ));

    expect($collection->count())->toBe(5);

    foreach($collection as $logEntry) {
        expect($logEntry)->toBeInstanceOf(MonologEntry::class);
        expect($logEntry['level'])->toBeString();
    }
});

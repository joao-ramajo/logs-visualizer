<?php

use Ramajo\Core\Collections\MonologEntryCollection;
use Ramajo\Core\Entities\MonologEntry;

beforeEach(function() {
    $this->collection = new MonologEntryCollection();

    $this->collection->add(new MonologEntry(
        timestamp: '2025-10-11 14:23:01',
        level: 'ERROR',
        message: 'Unexpected token in JSON payload at line 23'
    ));

    $this->collection->add(new MonologEntry(
        timestamp: '2025-10-11 14:23:15',
        level: 'INFO',
        message: 'Application terminated gracefully.'
    ));

    $this->collection->add(new MonologEntry(
        timestamp: '2025-10-11 14:22:01',
        level: 'INFO',
        message: 'Application started successfully.'
    ));

    $this->collection->add(new MonologEntry(
        timestamp: '2025-10-11 14:22:02',
        level: 'DEBUG',
        message: 'Loaded configuration file: /config/app.php'
    ));

    $this->collection->add(new MonologEntry(
        timestamp: '2025-10-11 14:22:05',
        level: 'WARNING',
        message: 'Cache directory not found, using default.'
    ));
});

test('lista corretamente uma série de entidades', function () {
    $coll = $this->collection;

    expect($coll->all())->toBeArray();
    expect(count($coll->all()))->toBe(5);
});

test('', function(){expect(false)->toBeTrue();});
echo "teste";
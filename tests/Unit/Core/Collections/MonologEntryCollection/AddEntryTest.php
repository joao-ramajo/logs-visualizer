<?php

use Ramajo\Core\Collections\MonologEntryCollection;
use Ramajo\Core\Entities\MonologEntry;

test('adiciona uma entidade corretamente dentro da coleção', function() {
    $collection = new MonologEntryCollection();

    $entry = new MonologEntry(
        timestamp: new DateTimeImmutable(),
        level: '',
        message: ''
    );

    expect($collection->count())->toBe(0);

    $collection->add($entry);

    expect($collection->count())->toBe(1);

    foreach($collection as $entry){
        expect($entry)->toBeInstanceOf(MonologEntry::class);
    }
});

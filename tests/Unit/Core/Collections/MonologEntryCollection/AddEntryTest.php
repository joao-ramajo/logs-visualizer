<?php

use Ramajo\Core\Collections\MonologEntryCollection;
use Ramajo\Core\Entities\MonologEntry;
use Ramajo\Core\Factories\MonologEntryFactory;

test('adiciona uma entidade corretamente dentro da coleção', function() {
    $collection = new MonologEntryCollection();

    $entry = MonologEntryFactory::make();

    expect($collection->count())->toBe(0);

    $collection->add($entry);

    expect($collection->count())->toBe(1);

    foreach($collection as $entry){
        expect($entry)->toBeInstanceOf(MonologEntry::class);
    }
});

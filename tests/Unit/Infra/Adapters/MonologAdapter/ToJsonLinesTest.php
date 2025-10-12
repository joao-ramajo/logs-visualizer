<?php

use Ramajo\Core\Collections\MonologEntryCollection;
use Ramajo\Core\Entities\MonologEntry;
use Ramajo\Infra\Adapters\MonologAdapter;

beforeEach(function() {
    $this->adapter = new MonologAdapter();
});

test('retorna uma coleção no formato JSON corretamente', function() {
    $collection = new MonologEntryCollection();

    $collection->add(new MonologEntry(
        timestamp: new DateTimeImmutable(),
        level: 'DEBUG',
        message: 'Message'
    ));

    $json = $this->adapter->toJson($collection);

    expect($json)->toBeString();
});
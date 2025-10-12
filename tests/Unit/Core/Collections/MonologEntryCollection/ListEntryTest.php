<?php

use Ramajo\Core\Collections\MonologEntryCollection;
use Ramajo\Core\Entities\MonologEntry;
use Ramajo\Core\Factories\MonologEntryFactory;

beforeEach(function() {
    $this->collection = new MonologEntryCollection();

    $this->collection->add(MonologEntryFactory::make());

    $this->collection->add(MonologEntryFactory::make());

    $this->collection->add(MonologEntryFactory::make());

    $this->collection->add(MonologEntryFactory::make());

    $this->collection->add(MonologEntryFactory::make());
});

test('lista corretamente uma série de entidades', function () {
    $coll = $this->collection;

    expect($coll->all())->toBeArray();
    expect(count($coll->all()))->toBe(5);
});

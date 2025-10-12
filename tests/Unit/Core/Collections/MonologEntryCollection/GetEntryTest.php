<?php

use Ramajo\Core\Collections\MonologEntryCollection;
use Ramajo\Core\Entities\MonologEntry;
use Ramajo\Core\Exceptions\LogEntryNotFoundException;
use Ramajo\Core\Factories\MonologEntryFactory;

test('lança uma excessão ao tentar acessar um índice inexistente em uma coleção', function () {
    $collection = new MonologEntryCollection();

    $collection->add(MonologEntryFactory::make());

    $collection->get(2);
})->throws(LogEntryNotFoundException::class);

test('retorn uma entidade corretamente a partir de seu índice', function () {
    $collection = new MonologEntryCollection();

    $collection->add(MonologEntryFactory::make());

    $index = $collection->get(0);

    expect($index)->toBeInstanceOf(MonologEntry::class);
});

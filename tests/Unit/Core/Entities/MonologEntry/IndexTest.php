<?php

use Ramajo\Core\Entities\MonologEntry;

beforeEach(function() {
    $this->entry = new MonologEntry(new DateTimeImmutable(), 'INFO', 'Loremiplsum dolor amet');
});

test('retorna o level de debug', function() {
    expect($this->entry->getLevel())->toBeString();
    expect($this->entry->getLevel())->toBe('INFO');
});

test('retorna a mensagem do log', function() {
    $message = $this->entry->getmessage();

    expect($message)->toBeString();
    expect($message)->toBe('Loremiplsum dolor amet');
});

test('transforma uma instancia do log para um array', function() {
    $arr = $this->entry->toArray();

    expect($arr)->toBeArray();
});

test('transforma uma instancia do log para um json', function() {
    $json = $this->entry->toJson();

    expect($json)->toBeJson();
});
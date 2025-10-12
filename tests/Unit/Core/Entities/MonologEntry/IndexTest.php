<?php

use Ramajo\Core\Entities\MonologEntry;
use Ramajo\Core\Factories\MonologEntryFactory;

beforeEach(function() {
    $this->entry = MonologEntryFactory::make(message: 'Mensagem');
});

test('retorna o level de debug', function() {
    expect($this->entry->getLevel())->toBeString()->toBe('INFO');
});

test('retorna a mensagem do log', function() {
    $message = $this->entry->getmessage();
    
    expect($message)->toBeString()->toBe('Mensagem');
});

test('transforma uma instancia do log para um array', function() {
    $arr = $this->entry->toArray();

    expect($arr)->toBeArray();
});

test('transforma uma instancia do log para um json', function() {
    $json = $this->entry->toJson();

    expect($json)->toBeJson();
});
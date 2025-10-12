<?php

use Ramajo\Infra\Readers\FileReader;

test('devolve às útlimas 2 linhas de um arquivo', function() {
    $reader = new FileReader();

    $tail = $reader->tail('mock/arquivo.log', 2);

    expect($tail)->toBeArray();

    expect(count($tail))->toBe(2);
});

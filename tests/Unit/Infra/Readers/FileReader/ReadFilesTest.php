<?php

use Ramajo\Core\Entities\File;
use Ramajo\Core\Exceptions\LogFileNotFoundException;
use Ramajo\Infra\Readers\FileReader;

test('retorna um array com as informações de um arquivo corretamente', function() {
    $file = dirname(__DIR__, 5) . '/mock/arquivo.log';

    $reader = new FileReader();

    $res = $reader->read(new File($file));

    expect($res)->toBeArray();
});

test('lança uma excessão se não encontrar o arquivo', function() {
    $file = 'arquivo-inexistente.log';

    $reader = new FileReader();

    $reader->read(new File($file));
})->throws(LogFileNotFoundException::class);
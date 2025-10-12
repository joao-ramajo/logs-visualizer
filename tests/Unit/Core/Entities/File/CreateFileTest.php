<?php

use Ramajo\Core\Entities\File;

test('cria uma instancia de file corretamente', function() {
    $path = 'mock/arquivo.log';

    $file = new File($path);

    expect($file)->toBeInstanceOf(File::class);
});
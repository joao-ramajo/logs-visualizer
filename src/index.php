<?php

use Ramajo\Infra\Adapters\MonologAdapter;
use Ramajo\Infra\Readers\FileReader;

require_once __DIR__ . '/bootstrap.php';

$reader = new FileReader();

$res = $reader->read('src/arquivo.log');

$adapter = new MonologAdapter();

var_dump($adapter->parse($res));

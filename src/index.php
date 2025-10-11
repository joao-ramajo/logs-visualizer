<?php

use Ramajo\Infra\Adapters\MonologAdapter;
use Ramajo\Infra\Readers\FileReader;

require_once __DIR__ . '/bootstrap.php';

$reader = new FileReader();

$res = $reader->read('mock/arquivo.log');

$adapter = new MonologAdapter();

$collection = $adapter->parse($res);


$entry = $collection->get(0);

var_dump($entry);

echo $entry->getLevel();
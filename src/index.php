<?php

require_once __DIR__ . '/bootstrap.php';

use Ramajo\Core\Entities\File;
use Ramajo\Infra\Adapters\MonologAdapter;
use Ramajo\Infra\Readers\FileReader;


// $reader = new FileReader();

// // $res = $reader->read('mock/arquivo.log');

// $adapter = new MonologAdapter();

// // $collection = $adapter->parse($res);

// $tail = $reader->tail('mock/arquivo.log');

// $collection = $adapter->parse($tail);

$file = new File('mock/arquivo.log');

<?php

require_once __DIR__ . '/bootstrap.php';

use Ramajo\App\LogVisualizer;
use Ramajo\Core\Entities\File;
use Ramajo\Infra\Adapters\MonologAdapter;
use Ramajo\Infra\Readers\FileReader;
use Ramajo\Infra\Strategies\MonologStrategy;

// $reader = new FileReader();

// $file = new File('mock/arquivo.log');

// $res = $reader->read($file);

// $adapter = new MonologAdapter();

// $collection = $adapter->parse($res);

// var_dump($collection);
// $tail = $reader->tail('mock/arquivo.log');

// $collection = $adapter->parse($tail);

$visualizer = new LogVisualizer('mock/arquivo.log', new MonologStrategy());

var_dump($visualizer->tail());
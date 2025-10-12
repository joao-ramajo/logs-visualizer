<?php

require_once __DIR__ . '/bootstrap.php';

use Ramajo\App\LogVisualizer;

use Ramajo\Infra\Strategies\MonologStrategy;

$visualizer = new LogVisualizer('mock/arquivo.log', new MonologStrategy());

var_dump($visualizer->tail());
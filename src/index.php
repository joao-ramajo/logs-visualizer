<?php

require_once __DIR__ . '/bootstrap.php';

use Ramajo\App\LogVisualizer;
use Ramajo\Infra\Strategies\MonologStrategy;

$visualizer = new LogVisualizer('mock/laravel.log', new MonologStrategy());

$collection = $visualizer->tail();

$json = $collection->toJson();
$index = $collection->get(5213);

var_dump($index);
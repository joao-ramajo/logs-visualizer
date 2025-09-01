<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'home');

Route::get('home', [MainController::class, 'index'])->name('home');
Route::get('service/{id}', [MainController::class, 'service'])->name('services.index');

Route::resource('services', ServiceController::class);

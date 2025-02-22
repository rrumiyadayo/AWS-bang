<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::get('/', ['App\Http\Controllers\TodoController', 'index']);

Route::resource('todos', 'App\Http\Controllers\TodoController');

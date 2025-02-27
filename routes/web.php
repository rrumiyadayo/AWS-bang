<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoController::class, 'index']);

Route::resource('todos', TodoController::class);

Route::post('/ai-response', [TodoController::class, 'getAiResponse']);

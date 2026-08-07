<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('todos.index'));

Route::resource('todos', TodoController::class)->only(['index', 'store', 'update', 'destroy']);

Route::get('/debug-glitchtip', function () {
    throw new Exception('Test GlitchTip error!');
});
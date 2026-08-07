<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('todos.index'));

Route::resource('todos', TodoController::class)->only(['index', 'store', 'update', 'destroy']);

Route::get('/test-sentry', function () {
    throw new Exception('Hore! Sentry berhasil menangkap error dari Coolify!');
});
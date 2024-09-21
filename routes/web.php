<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    echo 'main';
});

// Auth routes
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authenticate']); // Realiza a autenticação
Route::get('/logout', [AuthController::class, 'logout']);

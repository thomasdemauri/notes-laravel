<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\UserIsLogged;
use App\Http\Middleware\UserIsNotLogged;

// Auth routes  - Essas rotas só poderam ser acessada se o usuário NÃO estiver logado.
Route::middleware([UserIsNotLogged::class])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login_form');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate_user'); // Realiza a autenticação
});


// Aqui é necessário que o usuário esteja autenticado, então todas as rotas passarão pelo middleware apontado.
Route::middleware([UserIsLogged::class])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [MainController::class, 'index'])->name('home');

    // Cria uma nota
    Route::get('/create', [MainController::class, 'create'])->name('create_note_form');

    // Edita uma nota
    Route::get('/edit-note/{id}', [MainController::class, 'edit'])->name('edit_note_form');

    // Deleta uma nota
    Route::get('/delete-note/{id}', [MainController::class, 'delete'])->name('delete_note');

    // Salva uma nota no banco de dados
    Route::post('/store', [MainController::class, 'store'])->name('store_note');

    // Atualiza uma nota
    Route::post('/update', [MainController::class, 'update'])->name('update_note');



});
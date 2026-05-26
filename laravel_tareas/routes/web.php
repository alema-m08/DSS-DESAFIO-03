<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/login', [AuthController::class, 'showLogin']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/registro', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/registro', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('/tareas', [TaskController::class, 'index'])->name('dashboard');
    Route::get('/tareas/crear', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tareas', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tareas/editar/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tareas/editar/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tareas/eliminar/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::post('/tareas/toggle/{id}', [TaskController::class, 'toggle'])->name('tasks.toggle');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

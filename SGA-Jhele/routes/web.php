<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FatherController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/usuarios', [UserController::class, 'index'])->name('users.index');

//Editar User

Route::get('/usuarios/{id}/editar', [UserController::class, 'edit'])->name('users.edit');
Route::put('/usuarios/{id}', [UserController::class, 'update'])->name('users.update');

//Eliminar
Route::get('/usuarios/{id}/confirmar', [UserController::class, 'confirm'])->name('users.confirm');
Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('users.destroy');

//Editar Foto:

Route::get('/usuarios/{id}/foto', [UserController::class, 'editPhoto'])->name('users.photo');
Route::put('/usuarios/{id}/foto-update', [UserController::class, 'updatePhoto'])->name('users.photo.update');

Route::get('/usuarios/nuevo', [UserController::class, 'create'])->name('users.create');
Route::post('/usuarios/guardar', [UserController::class, 'store'])->name('users.store');




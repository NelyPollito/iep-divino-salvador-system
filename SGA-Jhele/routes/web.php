<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FatherController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

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

Route::get('/alumnos/completar/{iduser}', [StudentController::class, 'create'])->name('students.complete');
Route::post('/alumnos/guardar-perfil', [StudentController::class, 'store'])->name('students.store');


Route::get('/docentes/completar/{iduser}', [TeacherController::class, 'create'])->name('teachers.complete');
Route::post('/docentes/guardar-perfil', [TeacherController::class, 'store'])->name('teachers.store');


Route::get('/padres/completar/{iduser}', [FatherController::class, 'create'])->name('fathers.complete');
Route::post('/padres/guardar-perfil', [FatherController::class, 'store'])->name('fathers.store');



//MOSTRAR STUDENTS:
Route::get('/alumnos/mostrar', [StudentController::class, 'index'])->name('students.index');

// ACTUALIZAR ESTUDENTS 
Route::get('/alumnos/editar/{id}', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/alumnos/actualizar/{id}', [StudentController::class, 'update'])->name('students.update');

// SHOW
Route::get('/alumnos/informacion/{id}', [StudentController::class, 'show'])->name('students.show');

//Delete 
Route::get('/alumnos/eliminar/{id}', [StudentController::class, 'delete'])->name('students.delete');
// Usamos DELETE por estándar de Laravel, aunque solo desactivemos
Route::delete('/alumnos/desactivar/{id}', [StudentController::class, 'destroy'])->name('students.destroy');

//Foto
Route::get('/alumnos/foto/{id}', [StudentController::class, 'editPhoto'])->name('userss.photo');
Route::put('/alumnos/foto-actualizar/{id}', [StudentController::class, 'updatePhoto'])->name('userss.photo_update');



//MOSTRAR TEACHERS
Route::get('/docentes/mostrar', [TeacherController::class, 'index'])->name('teachers.index');

//Editar
Route::get('/docentes/editar/{id}', [TeacherController::class, 'edit'])->name('teachers.edit');
Route::put('/docentes/actualizar/{id}', [TeacherController::class, 'update'])->name('teachers.update');

//Eliminar 
Route::get('/docentes/eliminar/{id}', [TeacherController::class, 'delete'])->name('teachers.delete');
Route::delete('/docentes/desactivar/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');

// PHOTO
Route::get('/docentes/foto/{id}', [TeacherController::class, 'editPhoto'])->name('teachers.photo');
Route::put('/docentes/foto-actualizar/{id}', [TeacherController::class, 'updatePhoto'])->name('teachers.photo_update');

//show
Route::get('/docentes/informacion/{id}', [TeacherController::class, 'show'])->name('teachers.show');

//MOSTRAR Fathers

Route::get('/padres', [FatherController::class, 'index'])->name('fathers.index');

//Editar
Route::get('/padres/editar/{id}', [FatherController::class, 'edit'])->name('fathers.edit');
Route::put('/padres/actualizar/{id}', [FatherController::class, 'update'])->name('fathers.update');

//Delete
Route::get('/padres/eliminar/{id}', [FatherController::class, 'confirmDelete'])->name('fathers.confirm-delete');
Route::delete('/padres/desactivar/{id}', [FatherController::class, 'destroy'])->name('fathers.destroy');

//PHOTO
Route::get('/padres/foto/{id}', [FatherController::class, 'editPhoto'])->name('fathers.photo');
Route::put('/padres/foto-actualizar/{id}', [FatherController::class, 'updatePhoto'])->name('fathers.update-photo');

//SHOW
Route::get('/padres/informacion/{id}', [FatherController::class, 'show'])->name('fathers.show');

//Contrasena
Route::get('/padres/contrasena/{id}', [FatherController::class, 'editPassword'])->name('fathers.edit-password');
Route::put('/padres/contrasena-actualizar/{id}', [FatherController::class, 'updatePassword'])->name('fathers.update-password');

//Agregar Hijo

Route::get('/padres/hijos/{id}', [FatherController::class, 'showAddHijo'])->name('fathers.hijos');
Route::post('/padres/hijos-guardar', [FatherController::class, 'storeHijo'])->name('fathers.store-hijo');

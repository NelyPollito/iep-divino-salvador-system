<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DegreeController;
use App\Http\Controllers\FatherController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SubgradeController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
Route::get('/father/dashboard', [FatherController::class, 'dashboard'])->name('father.dashboard');


// USUARIOS
Route::get('/usuarios', [UserController::class, 'index'])->name('users.index');

Route::get('/usuarios/{id}/editar', [UserController::class, 'edit'])->name('users.edit');
Route::put('/usuarios/{id}', [UserController::class, 'update'])->name('users.update');

Route::get('/usuarios/{id}/confirmar', [UserController::class, 'confirm'])->name('users.confirm');
Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('users.destroy');

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


// STUDENTS
Route::get('/alumnos/mostrar', [StudentController::class, 'index'])->name('students.index');

Route::get('/alumnos/editar/{id}', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/alumnos/actualizar/{id}', [StudentController::class, 'update'])->name('students.update');

Route::get('/alumnos/informacion/{id}', [StudentController::class, 'show'])->name('students.show');

Route::get('/alumnos/eliminar/{id}', [StudentController::class, 'delete'])->name('students.delete');
Route::delete('/alumnos/desactivar/{id}', [StudentController::class, 'destroy'])->name('students.destroy');

Route::get('/alumnos/foto/{id}', [StudentController::class, 'editPhoto'])->name('userss.photo');
Route::put('/alumnos/foto-actualizar/{id}', [StudentController::class, 'updatePhoto'])->name('userss.photo_update');


// TEACHERS
Route::get('/docentes/mostrar', [TeacherController::class, 'index'])->name('teachers.index');

Route::get('/docentes/editar/{id}', [TeacherController::class, 'edit'])->name('teachers.edit');
Route::put('/docentes/actualizar/{id}', [TeacherController::class, 'update'])->name('teachers.update');

Route::get('/docentes/eliminar/{id}', [TeacherController::class, 'delete'])->name('teachers.delete');
Route::delete('/docentes/desactivar/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');

Route::get('/docentes/foto/{id}', [TeacherController::class, 'editPhoto'])->name('teachers.photo');
Route::put('/docentes/foto-actualizar/{id}', [TeacherController::class, 'updatePhoto'])->name('teachers.photo_update');

Route::get('/docentes/informacion/{id}', [TeacherController::class, 'show'])->name('teachers.show');


// FATHERS
Route::get('/padres', [FatherController::class, 'index'])->name('fathers.index');

Route::get('/padres/editar/{id}', [FatherController::class, 'edit'])->name('fathers.edit');
Route::put('/padres/actualizar/{id}', [FatherController::class, 'update'])->name('fathers.update');

Route::get('/padres/eliminar/{id}', [FatherController::class, 'confirmDelete'])->name('fathers.confirm-delete');
Route::delete('/padres/desactivar/{id}', [FatherController::class, 'destroy'])->name('fathers.destroy');

Route::get('/padres/foto/{id}', [FatherController::class, 'editPhoto'])->name('fathers.photo');
Route::put('/padres/foto-actualizar/{id}', [FatherController::class, 'updatePhoto'])->name('fathers.update-photo');

Route::get('/padres/informacion/{id}', [FatherController::class, 'show'])->name('fathers.show');

Route::get('/padres/contrasena/{id}', [FatherController::class, 'editPassword'])->name('fathers.edit-password');
Route::put('/padres/contrasena-actualizar/{id}', [FatherController::class, 'updatePassword'])->name('fathers.update-password');


// PERIOD
Route::get('/periodos', [PeriodController::class, 'index'])->name('periods.index');

Route::get('/periodos/nuevo', [PeriodController::class, 'create'])->name('periods.create');
Route::post('/periodos/guardar', [PeriodController::class, 'store'])->name('periods.store');

Route::get('/periodos/{id}/editar', [PeriodController::class, 'edit'])->name('periods.edit');
Route::put('/periodos/{id}/actualizar', [PeriodController::class, 'update'])->name('periods.update');

Route::get('/periodos/{id}/eliminar', [PeriodController::class, 'showDelete'])->name('periods.showDelete');
Route::delete('/periodos/{id}/desactivar', [PeriodController::class, 'destroy'])->name('periods.destroy');


// SEMESTRE
Route::get('/semestres', [SemesterController::class, 'index'])->name('semesters.index');

Route::get('/semestres/nuevo', [SemesterController::class, 'create'])->name('semesters.create');
Route::post('/semestres/guardar', [SemesterController::class, 'store'])->name('semesters.store');

Route::get('/semestres/{id}/editar', [SemesterController::class, 'edit'])->name('semesters.edit');
Route::put('/semestres/{id}/actualizar', [SemesterController::class, 'update'])->name('semesters.update');

Route::get('/semestres/{id}/eliminar', [SemesterController::class, 'showDelete'])->name('semesters.showDelete');
Route::delete('/semestres/{id}/desactivar', [SemesterController::class, 'destroy'])->name('semesters.destroy');


// DEGREES
Route::get('/grados', [DegreeController::class, 'index'])->name('degrees.index');

Route::get('/grados/nuevo', [DegreeController::class, 'create'])->name('degrees.create');
Route::post('/grados/guardar', [DegreeController::class, 'store'])->name('degrees.store');

Route::get('/grados/{id}/editar', [DegreeController::class, 'edit'])->name('degrees.edit');
Route::put('/grados/{id}/actualizar', [DegreeController::class, 'update'])->name('degrees.update');

Route::get('/grados/{id}/eliminar', [DegreeController::class, 'showDelete'])->name('degrees.showDelete');
Route::delete('/grados/{id}/desactivar', [DegreeController::class, 'destroy'])->name('degrees.destroy');


// SUBGRADES
Route::get('/subgrados', [SubgradeController::class, 'index'])->name('subgrades.index');

Route::get('/subgrados/nuevo', [SubgradeController::class, 'create'])->name('subgrades.create');
Route::post('/subgrados/guardar', [SubgradeController::class, 'store'])->name('subgrades.store');

Route::get('/subgrados/{id}/editar', [SubgradeController::class, 'edit'])->name('subgrades.edit');
Route::put('/subgrados/{id}/actualizar', [SubgradeController::class, 'update'])->name('subgrades.update');

Route::get('/subgrados/{id}/eliminar', [SubgradeController::class, 'showDelete'])->name('subgrades.showDelete');
Route::delete('/subgrados/{id}/desactivar', [SubgradeController::class, 'destroy'])->name('subgrades.destroy');


// COURSES
Route::get('/cursos', [CourseController::class, 'index'])->name('courses.index');

Route::get('/cursos/nuevo', [CourseController::class, 'create'])->name('courses.create');
Route::post('/cursos/guardar', [CourseController::class, 'store'])->name('courses.store');

Route::get('/cursos/{id}/editar', [CourseController::class, 'edit'])->name('courses.edit');
Route::put('/cursos/{id}/actualizar', [CourseController::class, 'update'])->name('courses.update');

Route::get('/cursos/{id}/eliminar', [CourseController::class, 'showDelete'])->name('courses.showDelete');
Route::delete('/cursos/{id}/desactivar', [CourseController::class, 'destroy'])->name('courses.destroy');

Route::get('/cursos/{id}/foto', [CourseController::class, 'editPhoto'])->name('courses.editPhoto');
Route::put('/cursos/{id}/foto-actualizar', [CourseController::class, 'updatePhoto'])->name('courses.updatePhoto');


// SECTIONS
Route::get('/secciones', [SectionController::class, 'index'])->name('sections.index');

Route::get('/secciones/nuevo', [SectionController::class, 'create'])->name('sections.create');
Route::post('/secciones/guardar', [SectionController::class, 'store'])->name('sections.store');

Route::get('/secciones/{id}/editar', [SectionController::class, 'edit'])->name('sections.edit');
Route::put('/secciones/{id}', [SectionController::class, 'update'])->name('sections.update');

Route::get('/secciones/{id}/eliminar', [SectionController::class, 'showDelete'])->name('sections.showDelete');
Route::delete('/secciones/{id}/desactivar', [SectionController::class, 'destroy'])->name('sections.destroy');

// Ver detalles de la sección y lista de alumnos
Route::get('/secciones/{id}/gestionar', [SectionController::class, 'manage'])->name('sections.manage');

Route::post('/secciones/inscribir', [SectionController::class, 'enrollStudent'])->name('sections.enroll');
Route::delete('/secciones/retirar/{id}', [SectionController::class, 'unenrollStudent'])->name('sections.unenroll');


// NOTAS / GRADES
Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');

Route::get('/grades/create', [GradeController::class, 'create'])->name('grades.create');
Route::post('/grades/store', [GradeController::class, 'store'])->name('grades.store');

// AJAX para cargar tipos de evaluación
Route::get('/get-evaluation-types', [GradeController::class, 'getEvaluationTypes'])->name('grades.getEvaluationTypes');

Route::get('/grades/get-edit-data', [GradeController::class, 'getEditData'])->name('grades.getEditData');
Route::post('/grades/update', [GradeController::class, 'update'])->name('grades.update');


// ASISTENCIA / ATTENDANCE
Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');

Route::get('/attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
Route::post('/attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');

Route::get('/attendance/get-edit-data', [AttendanceController::class, 'getEditData'])->name('attendance.getEditData');
Route::post('/attendance/update', [AttendanceController::class, 'update'])->name('attendance.update');

Route::get('/attendance/show-details', [AttendanceController::class, 'showDetails'])->name('attendance.showDetails');


// MENSAJERÍA INTERNA
Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
Route::get('/messages/inbox', [MessageController::class, 'inbox'])->name('messages.inbox');
Route::get('/messages/sent', [MessageController::class, 'sent'])->name('messages.sent');
Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');


// Rutas para los selects dinámicos
Route::get('/get-grades/{id}', [FilterController::class, 'getGrades']);
Route::get('/get-subgrades/{id}', [FilterController::class, 'getSubgrades']);
Route::get('/get-courses/{id}', [FilterController::class, 'getCourses']);
Route::get('/get-sections/{id}', [FilterController::class, 'getSections']);
Route::get('/get-students-section/{id}', [FilterController::class, 'getStudentsBySection']);
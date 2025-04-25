<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherStudentEvaluationController;

/*
|--------------------------------------------------------------------------
| Admin Login Routes (غير محمية)
|--------------------------------------------------------------------------
*/

// Routes for Admin Authentication
Route::get('admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
// Protected Routes for Admin (middleware auth:admin)


Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/students', StudentController::class);
    Route::resource('/subjects', SubjectController::class);
    Route::resource('/teachers', TeacherController::class);
    Route::resource('/evaluations', TeacherStudentEvaluationController::class);
    Route::get('/students/export-excel', [StudentController::class, 'exportExcel'])->name('students.export.excel');
    Route::post('/students/import', [App\Http\Controllers\StudentController::class, 'import'])->name('students.import');

});

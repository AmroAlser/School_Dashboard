<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherStudentEvaluationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PaperController;

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
    Route::resource('/semesters', \App\Http\Controllers\SemesterController::class);
    Route::resource('/grades', \App\Http\Controllers\GradeController::class);
    Route::resource('/classes', \App\Http\Controllers\SchoolClassController::class);
    Route::resource('/courses', CourseController::class);
    Route::resource('/papers', PaperController::class);
    Route::get('/reports/students', [ReportController::class, 'studentsReport'])->name('reports.students');
    Route::get('/reports/grades', [ReportController::class, 'gradesReport'])->name('reports.grades');
    Route::get('/reports/semesters', [ReportController::class, 'semestersReport'])->name('reports.semesters');
    Route::get('/reports/allstudents', [ReportController::class, 'exportallStudents'])->name('reports.allstudents');
    Route::get('reports/teachers', [ReportController::class, 'exportTeachers'])->name('reports.teachers');
    Route::post('/students/import', [App\Http\Controllers\StudentController::class, 'import'])->name('students.import');
    Route::get('/export/students', [ReportController::class, 'exportStudentsReport'])->name('export.students');
    Route::get('/export/grades', [ReportController::class, 'exportGradesReport'])->name('export.grades');
    Route::get('/export/semesters', [ReportController::class, 'exportSemestersReport'])->name('export.semesters');
});

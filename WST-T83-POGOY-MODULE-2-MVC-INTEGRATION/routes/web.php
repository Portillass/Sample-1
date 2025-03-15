<?php
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController; 

Route::get('/', function () {
    return view('welcome');
});    

Route::middleware(['auth', 'student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/admin/enrollments', [EnrollmentController::class, 'index'])->name('admin.enrollments');
    Route::get('/enrollment', [EnrollmentController::class, 'create'])->name('enrollment.create');
    Route::post('/enrollment', [EnrollmentController::class, 'store'])->name('enrollment.store');
    Route::get('/enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');
    Route::get('/enrollments/{enrollment}/edit', [EnrollmentController::class, 'edit'])->name('enrollments.edit');
    Route::put('/enrollments/{enrollment}', [EnrollmentController::class, 'update'])->name('enrollments.update');
    Route::put('/enrollments/{enrollment}/archive', [EnrollmentController::class, 'archive'])->name('enrollments.archive');
    Route::get('/enrollments/archived', [EnrollmentController::class, 'archived'])->name('enrollments.archived');
    Route::put('/enrollments/{enrollment}/restore', [EnrollmentController::class, 'restore'])->name('enrollments.restore');
    Route::post('/student/{enrollment}/enroll-subjects', [EnrollmentController::class, 'enrollSubjects'])->name('student.enroll-subjects');
    Route::get('/student/{enrollment}/subjects', [EnrollmentController::class, 'subjects'])->name('student.subjects');
    Route::post('/student/{enrollment}/subjects', [EnrollmentController::class, 'enrollSubjects'])->name('student.enroll-subjects');
    Route::delete('/student/{enrollment}/subjects/{subject}', [EnrollmentController::class, 'dropSubject'])->name('student.drop-subject');

    Route::resource('subjects', SubjectController::class);
    Route::put('/subjects/{subject}/archive', [SubjectController::class, 'archive'])->name('subjects.archive');
    Route::get('/subjects-archived', [SubjectController::class, 'archived'])->name('subjects.archived');
    Route::put('/subjects/{subject}/restore', [SubjectController::class, 'restore'])->name('subjects.restore');

    Route::get('/grades/{enrollment}', [GradeController::class, 'index'])->name('grades.index');
    Route::post('/grades/{enrollment}', [GradeController::class, 'store'])->name('grades.store');
    Route::put('/grades/{grade}', [GradeController::class, 'update'])->name('grades.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';

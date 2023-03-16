<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\LessonScheduleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', BerandaController::class)->name('beranda');
    Route::prefix('profile')->name('profile.')->controller(ProfileController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::put('{user}', 'update')->name('update');
        Route::put('address/{user}', 'updateAddress')->name('update-address');
        Route::put('account/{user}', 'updateAccount')->name('update-account');
        Route::put('parents/{user}', 'updateParents')->name('update-parents');
        Route::put('guardian/{user}', 'updateGuardian')->name('update-guardian');
    });
        Route::prefix('data')->name('data.')->group(function () {
            Route::prefix('student')->name('student.')->controller(StudentController::class)->group(function () {
                Route::get('', 'index')->middleware(['auth.is.administrator'])->name('index');
                Route::get('get-data', 'getData')->middleware(['auth.is.administrator'])->name('getData');
                Route::get('create', 'create')->middleware(['auth.is.administrator'])->name('create');
                Route::post('', 'store')->middleware(['auth.is.administrator'])->name('store');
                Route::get('edit/{student}', 'edit')->middleware(['auth.is.administrator'])->name('edit');
                Route::put('{student}', 'update')->middleware(['auth.is.administrator'])->name('update');
                Route::delete('{student}', 'destroy')->middleware(['auth.is.administrator'])->name('destroy');
                Route::get('show-by-class-room', 'showByClassRoom')->middleware('auth.is.administrator.or.teacher')->name('show-by-class-room');
            });
            Route::prefix('school-year')->name('school-year.')->middleware(['auth.is.administrator'])->controller(SchoolYearController::class)->group(function () {
                Route::get('', 'index')->name('index');
                Route::get('get-data', 'getData')->name('getData');
                Route::get('create', 'create')->name('create');
                Route::post('', 'store')->name('store');
                Route::get('edit/{school_year}', 'edit')->name('edit');
                Route::put('{school_year}', 'update')->name('update');
                Route::delete('{school_year}', 'destroy')->name('destroy');
            });
            Route::prefix('teacher')->name('teacher.')->middleware(['auth.is.administrator'])->controller(TeacherController::class)->group(function () {
                Route::get('', 'index')->name('index');
                Route::get('get-data', 'getData')->name('getData');
                Route::get('create', 'create')->name('create');
                Route::post('', 'store')->name('store');
                Route::get('edit/{teacher}', 'edit')->name('edit');
                Route::put('{teacher}', 'update')->name('update');
                Route::delete('{teacher}', 'destroy')->name('destroy');
            });
            Route::prefix('subjects')->name('subjects.')->controller(SubjectsController::class)->group(function () {
                Route::get('', 'index')->middleware(['auth.is.administrator'])->name('index');
                Route::get('get-data', 'getData')->middleware(['auth.is.administrator'])->name('getData');
                Route::get('create', 'create')->middleware(['auth.is.administrator'])->name('create');
                Route::post('', 'store')->middleware(['auth.is.administrator'])->name('store');
                Route::get('edit/{subjects}', 'edit')->middleware(['auth.is.administrator'])->name('edit');
                Route::put('{subjects}', 'update')->middleware(['auth.is.administrator'])->name('update');
                Route::delete('{subjects}', 'destroy')->middleware(['auth.is.administrator'])->name('destroy');
                Route::get('show-by-class-room', 'showByClassRoom')->middleware('auth.is.administrator.or.teacher')->name('show-by-class-room');
            });
            Route::prefix('class-room')->name('class-room.')->controller(ClassRoomController::class)->group(function () {
                Route::get('', 'index')->middleware(['auth.is.administrator'])->name('index');
                Route::post('get-data', 'getData')->middleware(['auth.is.administrator'])->name('getData');
                Route::get('create', 'create')->middleware(['auth.is.administrator'])->name('create');
                Route::post('', 'store')->middleware(['auth.is.administrator'])->name('store');
                Route::get('student-add/{class_room}', 'studentAdd')->middleware(['auth.is.administrator'])->name('student-add');
                Route::put('student-add/{class_room}', 'studentAddStore')->middleware(['auth.is.administrator'])->name('student-add-store');
                Route::get('edit/{class_room}', 'edit')->middleware(['auth.is.administrator'])->name('edit');
                Route::put('{class_room}', 'update')->middleware(['auth.is.administrator'])->name('update');
                Route::delete('{class_room}', 'destroy')->middleware(['auth.is.administrator'])->name('destroy');
                Route::get('show-by-school-year', 'showBySchoolYear')->middleware('auth.is.administrator.or.teacher')->name('show-by-school-year');
            });
        });
        Route::prefix('lesson-schedule')->name('lesson-schedule.')->middleware(['auth.is.administrator'])->controller(LessonScheduleController::class)->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('get-data', 'getData')->name('getData');
            Route::get('create', 'create')->name('create');
            Route::post('', 'store')->name('store');
            Route::get('edit/{lesson_schedule}', 'edit')->name('edit');
            Route::put('{lesson_schedule}', 'update')->name('update');
            Route::delete('{lesson_schedule}', 'destroy')->name('destroy');
        });
    Route::prefix('grade')->name('grade.')->middleware('auth.is.administrator.or.teacher')->controller(GradeController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('get-data', 'getData')->name('getData');
        Route::get('create', 'create')->name('create');
        Route::post('', 'store')->name('store');
        Route::get('edit/{report}', 'edit')->name('edit');
        Route::put('{report}', 'update')->name('update');
        Route::delete('{report}', 'destroy')->name('destroy');
    });
    Route::prefix('report')->name('report.')->controller(ReportController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('get-data', 'getData')->name('getData');
        Route::get('show/{report}', 'show')->name('show');
        Route::get('show', 'showByFilter')->name('show-by-filter');
        Route::get('print/{report}', 'print')->name('print');
    });
});
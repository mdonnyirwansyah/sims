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
        Route::get('', 'index')->name('index');
    });
    Route::prefix('data')->name('data.')->group(function () {
        Route::prefix('student')->name('student.')->controller(StudentController::class)->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('get-data', 'getData')->name('getData');
            Route::get('create', 'create')->name('create');
            Route::post('', 'store')->name('store');
            Route::get('edit/{student}', 'edit')->name('edit');
            Route::put('{student}', 'update')->name('update');
            Route::delete('{student}', 'destroy')->name('destroy');
            Route::get('show-by-class-room', 'showByClassRoom')->name('show-by-class-room');
        });
        Route::prefix('teacher')->name('teacher.')->controller(TeacherController::class)->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('get-data', 'getData')->name('getData');
            Route::get('create', 'create')->name('create');
            Route::post('', 'store')->name('store');
            Route::get('edit/{teacher}', 'edit')->name('edit');
            Route::put('{teacher}', 'update')->name('update');
            Route::delete('{teacher}', 'destroy')->name('destroy');
        });
        Route::prefix('school-year')->name('school-year.')->controller(SchoolYearController::class)->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('get-data', 'getData')->name('getData');
            Route::get('create', 'create')->name('create');
            Route::post('', 'store')->name('store');
            Route::get('edit/{school_year}', 'edit')->name('edit');
            Route::put('{school_year}', 'update')->name('update');
            Route::delete('{school_year}', 'destroy')->name('destroy');
        });
        Route::prefix('subjects')->name('subjects.')->controller(SubjectsController::class)->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('get-data', 'getData')->name('getData');
            Route::get('create', 'create')->name('create');
            Route::post('', 'store')->name('store');
            Route::get('edit/{subjects}', 'edit')->name('edit');
            Route::put('{subjects}', 'update')->name('update');
            Route::delete('{subjects}', 'destroy')->name('destroy');
            Route::get('show-by-class-room', 'showByClassRoom')->name('show-by-class-room');
        });
        Route::prefix('class-room')->name('class-room.')->controller(ClassRoomController::class)->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('get-data', 'getData')->name('getData');
            Route::get('create', 'create')->name('create');
            Route::post('', 'store')->name('store');
            Route::get('student-add/{class_room}', 'studentAdd')->name('student-add');
            Route::put('student-add/{class_room}', 'studentAddStore')->name('student-add-store');
            Route::get('edit/{class_room}', 'edit')->name('edit');
            Route::put('{class_room}', 'update')->name('update');
            Route::delete('{class_room}', 'destroy')->name('destroy');
            Route::get('show-by-school-year', 'showBySchoolYear')->name('show-by-school-year');
        });
    });
    Route::prefix('lesson-schedule')->name('lesson-schedule.')->controller(LessonScheduleController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('get-data', 'getData')->name('getData');
        Route::get('create', 'create')->name('create');
        Route::post('', 'store')->name('store');
        Route::get('edit/{lesson_schedule}', 'edit')->name('edit');
        Route::put('{lesson_schedule}', 'update')->name('update');
        Route::delete('{lesson_schedule}', 'destroy')->name('destroy');
    });
    Route::prefix('grade')->name('grade.')->controller(GradeController::class)->group(function () {
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
    });
});
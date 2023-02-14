<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\StudentController;
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

Route::get('login', function () {
    return view('auth.login');
})->name('login');
Route::get('/', BerandaController::class)->name('beranda');
Route::get('profile', function () {
    return view('main.profile.student.index');
})->name('profile');
Route::prefix('data')->name('data.')->group(function () {
    Route::prefix('student')->name('student.')->controller(StudentController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('get-data', 'getData')->name('getData');
        Route::get('create', 'create')->name('create');
        Route::post('', 'store')->name('store');
        Route::get('edit/{student}', 'edit')->name('edit');
        Route::put('{student}', 'update')->name('update');
        Route::delete('{student}', 'destroy')->name('destroy');
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
    Route::prefix('school-year')->name('school-year.')->group(function () {
        Route::get('', function () {
            return view('main.data.school-year.index');
        })->name('index');
        Route::get('create', function () {
            return view('main.data.school-year.create');
        })->name('create');
    });
    Route::prefix('subjects')->name('subjects.')->group(function () {
        Route::get('', function () {
            return view('main.data.subjects.index');
        })->name('index');
        Route::get('create', function () {
            return view('main.data.subjects.create');
        })->name('create');
    });
    Route::prefix('class')->name('class.')->group(function () {
        Route::get('', function () {
            return view('main.data.class.index');
        })->name('index');
        Route::get('create', function (Request $request) {
            $request->validate([
                'school_year' => 'required',
                'class' => 'required'
            ]);

            $school_year = explode('|', $request->school_year);
            $data = [
                'school_year' => [
                    'id' => $school_year[0],
                    'name' => $school_year[1]
                ],
                'class' => $request->class
            ];

            return view('main.data.class.create', compact('data'));
        })->name('create');
        Route::post('store', function (Request $request) {
            $request->validate([
                'school_year_id' => 'required',
                'class' => 'required',
                'name' => 'required',
                'teacher_id' => 'required'
            ]);

            return "success";
        })->name('store');
        Route::get('student-add', function () {
            return view('main.data.class.student-add');
        })->name('student-add');
    });
});
Route::prefix('lesson-schedule')->name('lesson-schedule.')->group(function () {
    Route::get('', function () {
        return view('main.lesson-schedule.index');
    })->name('index');
    Route::get('create', function (Request $request) {
        $request->validate([
            'school_year' => 'required',
            'semester' => 'required',
            'teacher' => 'required'
        ]);
        $school_year = explode('|', $request->school_year);
        $teacher = explode('|', $request->teacher);
        $data = [
            'school_year' => [
                'id' => $school_year[0],
                'name' => $school_year[1]
            ],
            'semester' => $request->semester,
            'teacher' => [
                'id' => $teacher[0],
                'name' => $teacher[1]
            ],
        ];

        return view('main.lesson-schedule.create', compact('data'));
    })->name('create');
    Route::post('store', function (Request $request) {
        $request->validate([
            'school_year_id' => 'required',
            'teacher_id' => 'required',
            'class_id' => 'required',
            'day_id' => 'required',
            'time' => 'required'
        ]);

        return "success";
    })->name('store');
});
Route::prefix('grade')->name('grade.')->group(function () {
    Route::get('', function () {
        return view('main.grade.index');
    })->name('index');
    Route::get('create', function (Request $request) {
        $request->validate([
            'school_year' => 'required',
            'semester' => 'required',
            'class' => 'required',
            'type' => 'required',
        ]);

        $school_year = explode('|', $request->school_year);
        $class = explode('|', $request->class);
        $data = [
            'school_year' => [
                'id' => $school_year[0],
                'name' => $school_year[1]
            ],
            'semester' => $request->semester,
            'class' => [
                'id' => $class[0],
                'name' => $class[1]
            ],
            'type' => $request->type
        ];
        return view('main.grade.create', compact('data'));
    })->name('create');
});
Route::prefix('report')->name('report.')->group(function () {
    Route::get('', function () {
        return view('main.report.student.result');
    })->name('index');
    Route::get('result', function (Request $request) {
        $request->validate([
            'class' => 'required',
            'semester' => 'required'
        ]);

        $class = explode('|', $request->class);
        $data = [
            'class' => [
                'id' => $class[0],
                'name' => $class[1]
            ],
            'semester' => $request->semester
        ];

        return view('main.report.student.result', compact('data'));
    })->name('result');
});

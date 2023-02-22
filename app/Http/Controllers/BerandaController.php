<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Teacher;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BerandaController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();

        if ($user->role->name === 'Administrator') {
            $schoolYears = SchoolYear::orderBy('name', 'DESC')->get();
            $teachers = Teacher::all()->count();
            $students = Student::all()->count();
            $subjects = Subjects::all()->count();
            if ($request->school_year_id) {
                $classRooms = ClassRoom::where('school_year_id', $request->school_year_id)->get()->count();
            } else {
                $classRooms = ClassRoom::all()->count();
            }
            
            $data = [
                'title' => 'Beranda',
                'schoolYears' => $schoolYears,
                'classRooms' => $classRooms,
                'teachers' => $teachers,
                'students' => $students,
                'subjects' => $subjects
            ];
            
            return view('main.beranda.administrator.index', compact('data'));
        }

        $lessonSchedules = [];

        if ($user->role->name === 'Student') {
            $classRoom = $user->student->class_rooms()->whereRelation('school_year', 'status', '1')->first();
            
            if ($classRoom && $classRoom->lesson_schedules()->count() > 0) {
                $days = $classRoom->lesson_schedules()->whereRelation('school_year', 'status', '1')->groupBy('day_id')->get();

                foreach ($days as $index => $day) {
                    $schedules = $classRoom->lesson_schedules()->where('day_id', $day->day_id)->whereRelation('school_year', 'status', '1')->get()->map(function ($lessonSchedule) {
                        $data = [
                            'subjects' => $lessonSchedule->subjects->name,
                            'time' => Carbon::createFromFormat('H:i:s', $lessonSchedule->start_time)->format('H:i') .' - '. Carbon::createFromFormat('H:i:s', $lessonSchedule->end_time)->format('H:i')
                        ];
                        return $data;
                    });

                    $lessonSchedules[$index] = [
                        'day' => $day->day->name,
                            'schedules' => $schedules
                    ];
                }
            }
        } else if ($user->role->name === 'Teacher') {
            if ($user->teacher->lesson_schedules()->count() > 0) {
                $days = $user->teacher->lesson_schedules()->whereRelation('school_year', 'status', '1')->groupBy('day_id')->get();

                foreach ($days as $index => $day) {
                    $schedules = $user->teacher->lesson_schedules()->where('day_id', $day->day_id)->whereRelation('school_year', 'status', '1')->get()->map(function ($lessonSchedule) {
                        $data = [
                            'subjects' => $lessonSchedule->subjects->name,
                            'time' => Carbon::createFromFormat('H:i:s', $lessonSchedule->start_time)->format('H:i') .' - '. Carbon::createFromFormat('H:i:s', $lessonSchedule->end_time)->format('H:i')
                        ];
                        return $data;
                    });

                    $lessonSchedules[$index] = [
                        'day' => $day->day->name,
                            'schedules' => $schedules
                    ];
                }
            }
        }

        $data = [
            'title' => 'Beranda',
            'lessonSchedules' => $lessonSchedules
        ];

        return view('main.beranda.mix.index', compact('data'));
    }
}

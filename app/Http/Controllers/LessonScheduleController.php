<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonScheduleRequest;
use App\Http\Requests\LessonScheduleCreateRequest;
use App\Models\ClassRoom;
use App\Models\Day;
use App\Models\LessonSchedule;
use App\Models\SchoolYear;
use App\Models\Subjects;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LessonScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schoolYears = SchoolYear::orderBy('name', 'DESC')->get();

        $data = [
            'title' => 'Jadwal Pelajaran',
            'schoolYears' => $schoolYears
        ];

        return view('main.lesson-schedule.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        if ($request->school_year_id || $request->class_room_id || $request->semester) {
            $lessonSchedules = LessonSchedule::where('school_year_id', $request->school_year_id)->where('semester', $request->semester)->where('class_room_id', $request->class_room_id)->orderBy('day_id', 'ASC')->get();
        } else {
            $lessonSchedules = LessonSchedule::orderBy('day_id', 'ASC')->get();
        }

        return DataTables::of($lessonSchedules)
        ->addIndexColumn()
        ->editColumn('school_year', function($lessonSchedule) {
            return $lessonSchedule->school_year->name;
        })
        ->editColumn('class_room', function($lessonSchedule) {
            return $lessonSchedule->class_room->name;
        })
        ->editColumn('teacher', function($lessonSchedule) {
            return $lessonSchedule->teacher->user->name;
        })
        ->editColumn('subjects', function($lessonSchedule) {
            return $lessonSchedule->subjects->name;
        })
        ->editColumn('day', function($lessonSchedule) {
            return $lessonSchedule->day->name;
        })
        ->editColumn('time', function($lessonSchedule) {
            return $lessonSchedule->start_time. ' - ' . $lessonSchedule->end_time;
        })
        ->addColumn('action', function ($lessonSchedule) {
            return '
            <a href="'. route("lesson-schedule.edit", $lessonSchedule['id']) .'" class="btn btn-outline-info btn-xs mr-1" data-toggle="tooltip" data-placement="top" title="Edit">
                <i class="fa fa-pen"></i>
            </a>
            <button id="'. $lessonSchedule['id']. '" route="'. route("lesson-schedule.destroy", $lessonSchedule['id']) .'" onclick="handleDelete('. $lessonSchedule['id'] .')" type="button" class="btn btn-outline-danger btn-xs ml-1" data-toggle="tooltip" data-placement="top" title="Hapus">
                <i class="fa fa-trash"></i>
            </button>
            ';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schoolYears = SchoolYear::orderBy('name', 'DESC')->get();
        $teachers = Teacher::whereHas('user')->with(['user' => function ($query) {
            $query->orderBy('name', 'ASC');
        }])->get();
        $subjects = Subjects::orderBy('group', 'ASC')->orderBy('name', 'ASC')->get();
        $days = Day::orderBy('id', 'ASC')->get();
        
        $data = [
            'title' => 'Tambah Jadwal Pelajaran',
            'schoolYears' => $schoolYears,
            'teachers' => $teachers,
            'subjects' => $subjects,
            'days' => $days
        ];

        return view('main.lesson-schedule.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\LessonScheduleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LessonScheduleRequest $request)
    {
        try {
            LessonSchedule::create([
                'school_year_id' => $request->school_year_id,
                'semester' => $request->semester,
                'teacher_id' => $request->teacher_id,
                'class_room_id' => $request->class_room_id,
                'subjects_id' => $request->subjects_id,
                'day_id' => $request->day_id,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }

        return redirect()->route('lesson-schedule.index')->with('ok', 'Data berhasil ditambah!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LessonSchedule  $lessonSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(LessonSchedule $lessonSchedule)
    {
        $schoolYears = SchoolYear::orderBy('name', 'DESC')->get();
        $teachers = Teacher::whereHas('user')->with(['user' => function ($query) {
            $query->orderBy('name', 'ASC');
        }])->get();
        $classRooms = ClassRoom::orderBy('name', 'DESC')->get();
        $subjects = Subjects::orderBy('group', 'ASC')->orderBy('name', 'ASC')->get();
        $days = Day::orderBy('id', 'ASC')->get();
        
        $data = [
            'title' => 'Tambah Jadwal Pelajaran',
            'lessonSchedule' => $lessonSchedule,
            'schoolYears' => $schoolYears,
            'teachers' => $teachers,
            'classRooms' => $classRooms,
            'subjects' => $subjects,
            'days' => $days
        ];

        return view('main.lesson-schedule.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\LessonScheduleRequest  $request
     * @param  \App\Models\LessonSchedule  $lessonSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(LessonScheduleRequest $request, LessonSchedule $lessonSchedule)
    {
        try {
            $lessonSchedule->update([
                'school_year_id' => $request->school_year_id,
                'semester' => $request->semester,
                'teacher_id' => $request->teacher_id,
                'class_room_id' => $request->class_room_id,
                'subjects_id' => $request->subjects_id,
                'day_id' => $request->day_id,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }

        return redirect()->route('lesson-schedule.index')->with('ok', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LessonSchedule  $lessonSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(LessonSchedule $lessonSchedule)
    {
        try {
            $lessonSchedule->delete();
        } catch (\Exception $e) {
            return response()->json(['failed' => $e->getMessage()]);
        }

        return response()->json(['ok' => 'Data berhasil dihapus!']);
    }
}

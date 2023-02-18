<?php

namespace App\Http\Controllers;

use App\Http\Requests\GradeRequest;
use App\Models\Grade;
use App\Models\ClassRoom;
use App\Models\Report;
use App\Models\SchoolYear;
use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GradeController extends Controller
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
            'title' => 'Penilaian',
            'schoolYears' => $schoolYears
        ];

        return view('main.grade.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        if ($request->school_year_id || $request->semester || $request->class_room_id || $request->type) {
            $reports = Report::whereRelation('class_room', 'school_year_id', $request->school_year_id)->where('semester', $request->semester)->where('class_room_id', $request->class_room_id)->where('type', $request->type)->whereHas('student.user')->with(['student.user' => function ($query) {
            $query->orderBy('name', 'ASC');
        }])->get();
        } else {
            $reports = Report::whereHas('class_room')->with(['class_room' => function ($query) {
                $query->orderBy('name', 'ASC');
            }])->whereHas('student.user')->with(['student.user' => function ($query) {
            $query->orderBy('name', 'ASC');
        }])->get();
        }

        return DataTables::of($reports)
        ->addIndexColumn()
        ->editColumn('class_room', function($report) {
            return $report->class_room->name;
        })
        ->editColumn('student', function($report) {
            return $report->student->user->name;
        })
        ->addColumn('action', function ($report) {
            return '
            <a href="'. route("grade.edit", $report['id']) .'" class="btn btn-outline-info btn-xs mr-1" data-toggle="tooltip" data-placement="top" title="Edit">
                <i class="fa fa-pen"></i>
            </a>
            <button id="'. $report['id']. '" route="'. route("grade.destroy", $report['id']) .'" onclick="handleDelete('. $report['id'] .')" type="button" class="btn btn-outline-danger btn-xs ml-1" data-toggle="tooltip" data-placement="top" title="Hapus">
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
        $classRooms = ClassRoom::whereHas('school_year')->with(['school_year' => function ($query) {
            $query->orderBy('name', 'DESC');
        }])->orderBy('class', 'ASC')->orderBy('name', 'ASC')->get();
        $students = Student::whereHas('user')->with(['user' => function ($query) {
            $query->orderBy('name', 'ASC');
        }])->get();

        $data = [
            'title' => 'Tambah Penilaian',
            'schoolYears' => $schoolYears,
            'classRooms' => $classRooms,
            'students' => $students
        ];

        return view('main.grade.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\GradeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GradeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        //
    }
}

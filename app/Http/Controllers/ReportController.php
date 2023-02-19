<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\SchoolYear;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $schoolYears = SchoolYear::orderBy('name', 'DESC')->get();

        $data = [
            'title' => 'E-Raport',
            'schoolYears' => $schoolYears
        ];

        if($user->role->name === 'Student') {
            return view('main.report.student.index', compact('data'));
        }
        
        return view('main.report.mix.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        if ($request->school_year_id || $request->semester || $request->class_room_id) {
            $reports = Report::whereRelation('class_room', 'school_year_id', $request->school_year_id)->where('class_room_id', $request->class_room_id)->where('semester', $request->semester)->whereHas('student.user')->with(['student.user' => function ($query) {
            $query->orderBy('name', 'ASC');
        }])->groupBy('student_id')->get();
        } else {
            $reports = Report::whereHas('class_room')->with(['class_room' => function ($query) {
                $query->orderBy('name', 'ASC');
            }])->whereHas('student.user')->with(['student.user' => function ($query) {
            $query->orderBy('name', 'ASC');
        }])->groupBy('student_id')->get();
        }

        return DataTables::of($reports)
        ->addIndexColumn()
        ->editColumn('school_year', function($report) {
            return $report->class_room->school_year->name;
        })
        ->editColumn('class_room', function($report) {
            return $report->class_room->name;
        })
        ->editColumn('student', function($report) {
            return $report->student->user->name;
        })
        ->addColumn('action', function ($report) {
            return '
            <a href="'. route("report.show", $report['id']) .'" class="btn btn-outline-success btn-xs" data-toggle="tooltip" data-placement="top" title="Lihat">
                <i class="fa fa-eye"></i>
            </a>
            ';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        $student = Student::find($report->student_id);
        $studentData = [
            'name' => $student->user->name,
            'nis_nisn' => $student->nis. ' / ' .$student->nisn,
            'class_room' => $report->class_room->name,
            'semester' => $report->semester,
            'school_year' => $report->class_room->school_year->name
        ];
        $reports = $student->reports()->where('class_room_id', $report->class_room_id)->where('semester', $report->semester)->get();
        $data = [
            'title' => 'Lihat E-Raport',
            'studentData' => $studentData,
            'reports' => $reports
        ];
        
        return view('main.report.mix.show', compact('data'));
    }
}

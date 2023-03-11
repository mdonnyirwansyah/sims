<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportFilterRequest;
use App\Models\Report;
use App\Models\SchoolYear;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
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

        if($user->role->name === 'Student') {
            $classRooms = $user->student->class_rooms()->orderBy('class', 'DESC')->get();
    
            $data = [
                'title' => 'E-Raport',
                'classRooms' => $classRooms
            ];

            return view('main.report.student.index', compact('data'));
        }

        $schoolYears = SchoolYear::orderBy('name', 'DESC')->get();

        $data = [
            'title' => 'E-Raport',
            'schoolYears' => $schoolYears
        ];
        
        return view('main.report.mix.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        $user = Auth::user();
        if ($request->school_year_id || $request->semester || $request->class_room_id) {
            if ($user->role->name === 'Teacher') {
                $reports = Report::whereRelation('class_room', 'teacher_id', $user->teacher->id)->whereRelation('class_room', 'school_year_id', $request->school_year_id)->where('semester', $request->semester)->where('class_room_id', $request->class_room_id)->where('type', $request->type)->whereHas('class_room')->with(['class_room' => function ($query) {
                    $query->orderBy('name', 'ASC');
                }])->whereHas('student.user')->with(['student.user' => function ($query) {
                    $query->orderBy('name', 'ASC');
                }])->groupBy('semester')->get();
            } else {
                $reports = Report::whereRelation('class_room', 'school_year_id', $request->school_year_id)->where('semester', $request->semester)->where('class_room_id', $request->class_room_id)->where('type', $request->type)->whereHas('class_room')->with(['class_room' => function ($query) {
                    $query->orderBy('name', 'ASC');
                }])->whereHas('student.user')->with(['student.user' => function ($query) {
                    $query->orderBy('name', 'ASC');
                }])->groupBy('semester')->get();
            }
        } else {
            if ($user->role->name === 'Teacher') {
                $reports = Report::whereRelation('class_room', 'teacher_id', $user->teacher->id)->whereHas('class_room')->with(['class_room' => function ($query) {
                    $query->orderBy('name', 'ASC');
                }])->whereHas('student.user')->with(['student.user' => function ($query) {
                    $query->orderBy('name', 'ASC');
                }])->groupBy('semester')->get();
            } else {
                $reports = Report::whereHas('class_room')->with(['class_room' => function ($query) {
                    $query->orderBy('name', 'ASC');
                }])->whereHas('student.user')->with(['student.user' => function ($query) {
                    $query->orderBy('name', 'ASC');
                }])->groupBy('semester')->get();
            }
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
            'id' => $student->id,
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Requests\ReportFilterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function showByFilter(ReportFilterRequest $request)
    {
        $user = Auth::user();
        $classRoom = $user->student->class_rooms()->where('class_room_id', $request->class_room_id)->first();
        $report = $classRoom->reports()->where('class_room_id', $request->class_room_id)->where('semester', $request->semester)->latest()->first();
        $studentData = [
            'name' => $user->name,
            'nis_nisn' => $user->student->nis. ' / ' .$user->student->nisn,
            'class_room' => $classRoom->name,
            'semester' => $report->semester ?? '-',
            'school_year' => $report->class_room->school_year->name ?? '-'
        ];
        $reports = $user->student->reports()->where('class_room_id', $request->class_room_id)->where('semester', $request->semester)->get();
        $data = [
            'title' => 'Lihat E-Raport',
            'studentData' => $studentData,
            'reports' => $reports
        ];
        
        return view('main.report.student.show', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function print(Report $report)
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
            'studentData' => $studentData,
            'reports' => $reports
        ];
        $pdf = Pdf::loadView('main.report.mix.print', compact('data'))
        ->setPaper('a4');

        return $pdf->stream('e-raport-'. $student->nis);
    }
}

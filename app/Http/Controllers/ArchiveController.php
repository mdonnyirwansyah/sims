<?php

namespace App\Http\Controllers;

use App\Models\LessonSchedule;
use App\Models\SchoolYear;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ArchiveController extends Controller
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
            'title' => 'Rekap Penilaian',
            'schoolYears' => $schoolYears
        ];

        return view('main.grade.archive.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        $user = Auth::user();
        if ($request->school_year_id) {
            $reports = LessonSchedule::where('school_year_id', $request->school_year_id)->where('teacher_id', $user->teacher->id);
        } else {
            $reports = LessonSchedule::where('teacher_id', $user->teacher->id);
        }

        return DataTables::of($reports)
        ->addIndexColumn()
        ->editColumn('school_year', function ($report) {
            return $report->school_year->name;
        })
        ->editColumn('class_room', function ($report) {
            return $report->class_room->name;
        })
        ->editColumn('subjects', function ($report) {
            return $report->subjects->name;
        })
        ->addColumn('action', function ($report) {
            return '
            <a href="'. route("grade.archive.show", $report['id']) .'" class="btn btn-outline-info btn-xs mr-1" data-toggle="tooltip" data-placement="top" title="Lihat">
                <i class="fa fa-eye"></i>
            </a>
            ';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LessonSchedule  $lessonSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(LessonSchedule $lessonSchedule)
    {
        $report = [
            'pengetahuan' => [],
            'keterampilan' => []
        ];

        $report['pengetahuan'] = Report::where('class_room_id', $lessonSchedule->class_room_id)->where('semester', $lessonSchedule->semester)->where('type', 'Pengetahuan')->get();
        $report['keterampilan'] = Report::where('class_room_id', $lessonSchedule->class_room_id)->where('semester', $lessonSchedule->semester)->where('type', 'Keterampilan')->get();

        $data = [
            'title' => 'Lihat Rekap Penilaian',
            'report' => $report,
        ];

        return view('main.grade.archive.show', compact('data'));
    }
}

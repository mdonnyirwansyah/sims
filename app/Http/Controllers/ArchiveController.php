<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\LessonSchedule;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
            <div style="display: flex; justify-content: center; gap: 5px;">
                <a href="'. route("grade.archive.show", $report['id']) .'" class="btn btn-outline-success btn-xs" data-toggle="tooltip" data-placement="top" title="Lihat">
                    <i class="fa fa-eye"></i>
                </a>
                <a href="'. route("grade.archive.edit", $report['id']) .'" class="btn btn-outline-info btn-xs" data-toggle="tooltip" data-placement="top" title="Edit">
                    <i class="fa fa-pen"></i>
                </a>
                <a href="'. route("grade.archive.print", $report['id']) .'" target="_blank" class="btn btn-outline-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Cetak">
                    <i class="fa fa-print"></i>
                </a>
            </div>
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

        $report['pengetahuan'] = Report::with(['grade' => function ($query) use ($lessonSchedule) {
            $query->where('subjects_id', $lessonSchedule->subjects_id);
        }])->where('class_room_id', $lessonSchedule->class_room_id)->where('semester', $lessonSchedule->semester)->where('type', 'Pengetahuan')->get();
        $report['keterampilan'] = Report::with(['grade' => function ($query) use ($lessonSchedule) {
            $query->where('subjects_id', $lessonSchedule->subjects_id);
        }])->where('class_room_id', $lessonSchedule->class_room_id)->where('semester', $lessonSchedule->semester)->where('type', 'Keterampilan')->get();

        $data = [
            'title' => 'Lihat Rekap Penilaian',
            'report' => $report,
            'lesson_schedule' => $lessonSchedule
        ];

        return view('main.grade.archive.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LessonSchedule  $lessonSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(LessonSchedule $lessonSchedule)
    {
        $report = [
            'pengetahuan' => [],
            'keterampilan' => []
        ];

        $report['pengetahuan'] = Report::with(['grade' => function ($query) use ($lessonSchedule) {
            $query->where('subjects_id', $lessonSchedule->subjects_id);
        }])->where('class_room_id', $lessonSchedule->class_room_id)->where('semester', $lessonSchedule->semester)->where('type', 'Pengetahuan')->get();
        $report['keterampilan'] = Report::with(['grade' => function ($query) use ($lessonSchedule) {
            $query->where('subjects_id', $lessonSchedule->subjects_id);
        }])->where('class_room_id', $lessonSchedule->class_room_id)->where('semester', $lessonSchedule->semester)->where('type', 'Keterampilan')->get();

        $data = [
            'title' => 'Edit Rekap Penilaian',
            'report' => $report,
            'lesson_schedule' => $lessonSchedule
        ];

        return view('main.grade.archive.edit', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LessonSchedule  $lessonSchedule
     * @return \Illuminate\Http\Response
     */
    public function print(LessonSchedule $lessonSchedule)
    {
        $report = [
            'pengetahuan' => [],
            'keterampilan' => []
        ];

        $report['pengetahuan'] = Report::with(['grade' => function ($query) use ($lessonSchedule) {
            $query->where('subjects_id', $lessonSchedule->subjects_id);
        }])->where('class_room_id', $lessonSchedule->class_room_id)->where('semester', $lessonSchedule->semester)->where('type', 'Pengetahuan')->get();
        $report['keterampilan'] = Report::with(['grade' => function ($query) use ($lessonSchedule) {
            $query->where('subjects_id', $lessonSchedule->subjects_id);
        }])->where('class_room_id', $lessonSchedule->class_room_id)->where('semester', $lessonSchedule->semester)->where('type', 'Keterampilan')->get();

        $data = [
            'title' => 'Rekap Penilaian',
            'report' => $report,
            'lesson_schedule' => $lessonSchedule
        ];

        $pdf = Pdf::loadView('main.grade.archive.print', compact('data'))
        ->setPaper('a4');

        return $pdf->stream('Rekap-Nilai-' . $lessonSchedule->subjects->name . '-' . $lessonSchedule->class_room->name. '-Tahun-Pelajaran' . $lessonSchedule->school_year->name);
    }
}

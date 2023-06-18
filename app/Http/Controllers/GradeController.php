<?php

namespace App\Http\Controllers;

use App\Http\Requests\GradeStoreRequest;
use App\Http\Requests\GradeUpdateRequest;
use App\Models\Grade;
use App\Models\ClassRoom;
use App\Models\Report;
use App\Models\SchoolYear;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        return view('main.grade.input.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        $user = Auth::user();
        if ($request->school_year_id && $request->semester && $request->class_room_id && $request->type) {
            if ($user->role->name === 'Teacher') {
                $reports = Report::whereRelation('class_room', 'teacher_id', $user->teacher->id)->whereRelation('class_room', 'school_year_id', $request->school_year_id)->where('semester', $request->semester)->where('class_room_id', $request->class_room_id)->where('type', $request->type)->whereHas('class_room')->with(['class_room' => function ($query) {
                    $query->orderBy('name', 'ASC');
                }])->whereHas('student.user')->with(['student.user' => function ($query) {
                    $query->orderBy('name', 'ASC');
                }])->get();
            } else {
                $reports = Report::whereRelation('class_room', 'school_year_id', $request->school_year_id)->where('semester', $request->semester)->where('class_room_id', $request->class_room_id)->where('type', $request->type)->whereHas('class_room')->with(['class_room' => function ($query) {
                    $query->orderBy('name', 'ASC');
                }])->whereHas('student.user')->with(['student.user' => function ($query) {
                    $query->orderBy('name', 'ASC');
                }])->get();
            }
        } else {
            if ($user->role->name === 'Teacher') {
                $reports = Report::whereRelation('class_room', 'teacher_id', $user->teacher->id)->whereHas('class_room')->with(['class_room' => function ($query) {
                    $query->orderBy('name', 'ASC');
                }])->whereHas('student.user')->with(['student.user' => function ($query) {
                    $query->orderBy('name', 'ASC');
                }])->get();
            } else {
                $reports = Report::whereHas('class_room')->with(['class_room' => function ($query) {
                    $query->orderBy('name', 'ASC');
                }])->whereHas('student.user')->with(['student.user' => function ($query) {
                    $query->orderBy('name', 'ASC');
                }])->get();
            }
        }

        return DataTables::of($reports)
        ->addIndexColumn()
        ->editColumn('class_room', function ($report) {
            return $report->class_room->name;
        })
        ->editColumn('student', function ($report) {
            return $report->student->user->name;
        })
        ->addColumn('action', function ($report) {
            return '
            <a href="'. route("grade.input.edit", $report['id']) .'" class="btn btn-outline-info btn-xs mr-1" data-toggle="tooltip" data-placement="top" title="Edit">
                <i class="fa fa-pen"></i>
            </a>
            <button id="'. $report['id']. '" route="'. route("grade.input.destroy", $report['id']) .'" onclick="handleDelete('. $report['id'] .')" type="button" class="btn btn-outline-danger btn-xs ml-1" data-toggle="tooltip" data-placement="top" title="Hapus">
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

        $data = [
            'title' => 'Tambah Penilaian',
            'schoolYears' => $schoolYears
        ];

        return view('main.grade.input.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\GradeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GradeStoreRequest $request)
    {
        $exist = Report::where('student_id', $request->student_id)->where('semester', $request->semester)->where('class_room_id', $request->class_room_id)->where('type', $request->type)->first();

        if ($exist) {
            return response()->json(['exist' => 'Data sebelumnya sudah ada!']);
        }

        try {
            DB::beginTransaction();

            $reportCreated = Report::create([
                'student_id' => $request->student_id,
                'semester' => $request->semester,
                'class_room_id' => $request->class_room_id,
                'type' => $request->type
            ]);

            $reportCreated->grades()->createMany($request->subjects);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['failed' => $e->getMessage()]);
        }

        return response()->json(['ok' => 'Data berhasil ditambah!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        $schoolYears = SchoolYear::orderBy('name', 'DESC')->get();

        $data = [
            'title' => 'Edit Penilaian',
            'report' => $report,
            'schoolYears' => $schoolYears
        ];

        return view('main.grade.input.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\GradeUpdateRequest  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(GradeUpdateRequest $request, Report $report)
    {
        $grades = collect($request->subjects);

        try {
            foreach ($grades as $grade) {
                $gradeSelected = Grade::find($grade['id']);
                $gradeSelected->update([
                    'value' => $grade['value'],
                    'description' => $grade['description']
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }

        return redirect()->route('grade.input.index')->with('ok', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        try {
            $report->delete();
        } catch (\Exception $e) {
            return response()->json(['failed' => $e->getMessage()]);
        }

        return response()->json(['ok' => 'Data berhasil dihapus!']);
    }
}

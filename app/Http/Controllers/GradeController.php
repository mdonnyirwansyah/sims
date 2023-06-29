<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Report;
use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\LessonSchedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\GradeStoreRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\GradeUpdateRequest;
use App\Http\Requests\GradeSubjectsStoreRequest;

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
    public function getSubjects(Request $request)
    {
        $report = Report::with('grades')->where('student_id', $request->student_id)->where('class_room_id', $request->class_room_id)->where('semester', $request->semester)->where('type', $request->type)->first();

        if ($report) {
            $subjects = LessonSchedule::with(['subjects', 'subjects.grade' => function ($query) use ($report) {
                $query->where('report_id', $report->id);
            }])->where('class_room_id', $request->class_room_id)->where('school_year_id', $request->school_year_id)->where('semester', $request->semester)->get();

            return response()->json($subjects);
        } else {
            $subjects = LessonSchedule::with('subjects')->where('class_room_id', $request->class_room_id)->where('school_year_id', $request->school_year_id)->where('semester', $request->semester)->get();

            return response()->json($subjects);
        }
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
    public function createClassroom()
    {
        $schoolYears = SchoolYear::orderBy('name', 'DESC')->get();

        $data = [
            'title' => 'Tambah Penilaian',
            'schoolYears' => $schoolYears
        ];

        return view('main.grade.input.create-classroom', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSubjects()
    {
        $schoolYears = SchoolYear::orderBy('name', 'DESC')->get();

        $data = [
            'title' => 'Tambah Penilaian',
            'schoolYears' => $schoolYears
        ];

        return view('main.grade.input.create-subjects', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\GradeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GradeStoreRequest $request)
    {
        $report = Report::where('student_id', $request->student_id)->where('semester', $request->semester)->where('class_room_id', $request->class_room_id)->where('type', $request->type)->first();

        try {
            DB::beginTransaction();

            if ($report) {
                foreach ($request['subjects'] as $item) {
                    $grade = Grade::where('report_id', $report->id)->where('subjects_id', $item['subjects_id'])->first();
                    if ($grade) {
                        $grade->update([
                            'value' => $item['value'] ?? $grade->value,
                            'description' =>  $item['description'] ?? $grade->description
                        ]);
                    } else {
                        Grade::create([
                            'report_id' => $report->id,
                            'subjects_id' =>  $item['subjects_id'],
                            'value' => $item['value'] ?? 0,
                            'description' =>  $item['description'] ?? '-'
                        ]);
                    }
                }
            } else {
                $reportCreated = Report::create([
                    'student_id' => $request->student_id,
                    'semester' => $request->semester,
                    'class_room_id' => $request->class_room_id,
                    'type' => $request->type
                ]);

                foreach ($request['subjects'] as $item) {
                    Grade::create([
                        'report_id' => $reportCreated->id,
                        'subjects_id' =>  $item['subjects_id'],
                        'value' => $item['value'] ?? 0,
                        'description' =>  $item['description'] ?? '-'
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['failed' => $e->getMessage()]);
        }

        return response()->json(['ok' => 'Data berhasil ditambah!']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\GradeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSubjects(GradeSubjectsStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            foreach ($request['students'] as $item) {
                $report = Report::where('student_id', $item['id'])->where('semester', $request->semester)->where('class_room_id', trim(explode('|', $request->subjects_id)[0]))->where('type', $request->type)->first();

                if ($report) {
                    $grade = Grade::where('report_id', $report->id)->where('subjects_id', trim(explode('|', $request->subjects_id)[1]))->first();
                    if ($grade) {
                        $grade->update([
                            'value' => $item['value'] ?? $grade->value,
                            'description' =>  $item['description'] ?? $grade->description
                        ]);
                    } else {
                        Grade::create([
                            'report_id' => $report->id,
                            'subjects_id' =>  explode('|', $request->subjects_id)[1],
                            'value' => $item['value'] ?? 0,
                            'description' =>  $item['description'] ?? '-'
                        ]);
                    }
                } else {
                    $reportCreated = Report::create([
                        'student_id' => $item['id'],
                        'semester' => $request->semester,
                        'class_room_id' => explode('|', $request->subjects_id)[0],
                        'type' => $request->type
                    ]);

                    Grade::create([
                        'report_id' => $reportCreated->id,
                        'subjects_id' =>  explode('|', $request->subjects_id)[1],
                        'value' => $item['value'] ?? 0,
                        'description' =>  $item['description'] ?? '-'
                    ]);
                }
            }

            DB::commit();

            return response()->json(['ok' => 'Data berhasil ditambah!']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['failed' => $e->getMessage()]);
        }
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

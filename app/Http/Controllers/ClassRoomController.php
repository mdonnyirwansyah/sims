<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassRoomRequest;
use App\Http\Requests\ClassRoomCreateRequest;
use App\Http\Requests\ClassRoomStudentAddRequest;
use App\Models\ClassRoom;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClassRoomController extends Controller
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
            'title' => 'Data Kelas',
            'schoolYears' => $schoolYears
        ];

        return view('main.data.class-room.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        $classRooms = ClassRoom::orderBy('name', 'DESC')->get();

        if ($request->school_year_id || $request->class) {
            $classRooms = ClassRoom::where('school_year_id', $request->school_year_id)->where('class', $request->class)->orderBy('name', 'DESC')->get();
        }

        return DataTables::of($classRooms)
        ->addIndexColumn()
        ->editColumn('school_year', function($classRooms) {
            return $classRooms->school_year->name;
        })
        ->editColumn('teacher', function($classRooms) {
            return $classRooms->teacher->user->name;
        })
        ->addColumn('action', function ($classRoom) {
            return '
            <a href="'. route("data.class-room.edit", $classRoom['id']) .'" class="btn btn-outline-info btn-xs mr-1" data-toggle="tooltip" data-placement="top" title="Edit">
                <i class="fa fa-pen"></i>
            </a>
            <a href="'. route("data.class-room.student-add", $classRoom['id']) .'" class="btn btn-outline-success btn-xs mx-1" data-toggle="tooltip" data-placement="top" title="Tambah Siswa">
                <i class="fa fa-user-plus"></i>
            </a>
            <button id="'. $classRoom['id']. '" route="'. route("data.class-room.destroy", $classRoom['id']) .'" onclick="handleDelete('. $classRoom['id'] .')" type="button" class="btn btn-outline-danger btn-xs ml-1" data-toggle="tooltip" data-placement="top" title="Hapus">
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
        
        $data = [
            'title' => 'Data Kelas',
            'schoolYears' => $schoolYears,
            'teachers' => $teachers
        ];

        return view('main.data.class-room.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ClassRoomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassRoomRequest $request)
    {
        $existName = ClassRoom::where('school_year_id', $request->school_year_id)->where('name', $request->name)->first();
        $existTeacher = ClassRoom::where('school_year_id', $request->school_year_id)->where('teacher_id', $request->teacher_id)->first();

        if ($existName || $existTeacher) {
            return redirect()->back()->with('exist', 'Data sebelumnya sudah ada!');
        }

        try {
            ClassRoom::create([
                'school_year_id' => $request->school_year_id,
                'class' => $request->class,
                'name' => $request->name,
                'teacher_id' => $request->teacher_id
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }

        return redirect()->route('data.class-room.index')->with('ok', 'Data berhasil ditambah!');
    }

    /**
     * Show the form for student add to class room the specified resource.
     *
     * @param  \App\Models\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function studentAdd(ClassRoom $classRoom)
    {
        $students = Student::whereHas('user')->with(['user' => function ($query) {
            $query->orderBy('name', 'ASC');
        }])->get();

        $classRoomStudents = $classRoom->students->map(function ($item) {
            return $item->id;
        });

        $data = [
            'title' => 'Tambah Siswa',
            'classRoom' => $classRoom,
            'students' => $students,
            'classRoomStudents' => $classRoomStudents
        ];

        return view('main.data.class-room.student-add', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ClassRoomStudentAddRequest  $request
     * @param  \App\Models\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function studentAddStore(ClassRoomStudentAddRequest $request, ClassRoom  $classRoom)
    {
        try {
            $classRoom->students()->sync($request->students);
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }

        return redirect()->route('data.class-room.index')->with('ok', 'Data berhasil ditambah!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassRoom $classRoom)
    {
        $schoolYears = SchoolYear::orderBy('name', 'DESC')->get();
        $teachers = Teacher::whereHas('user')->with(['user' => function ($query) {
            $query->orderBy('name', 'ASC');
        }])->get();
        
        $data = [
            'title' => 'Edit Kelas',
            'classRoom' => $classRoom,
            'schoolYears' => $schoolYears,
            'teachers' => $teachers
        ];


        return view('main.data.class-room.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ClassRoomRequest  $request
     * @param  \App\Models\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function update(ClassRoomRequest $request, ClassRoom $classRoom)
    {
        $existName = ClassRoom::whereNotIn('id', [$classRoom->id])->where('school_year_id', $request->school_year_id)->where('name', $request->name)->first();
        $existTeacher = ClassRoom::whereNotIn('id', [$classRoom->id])->where('school_year_id', $request->school_year_id)->where('teacher_id', $request->teacher_id)->first();

        if ($existName || $existTeacher) {
            return redirect()->back()->with('exist', 'Data sebelumnya sudah ada!');
        }
        
        try {
            $classRoom->update([
                'school_year_id' => $request->school_year_id,
                'class' => $request->class,
                'name' => $request->name,
                'teacher_id' => $request->teacher_id
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }

        return redirect()->route('data.class-room.index')->with('ok', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassRoom $classRoom)
    {
        try {
            $classRoom->delete();
        } catch (\Exception $e) {
            return response()->json(['failed' => $e->getMessage()]);
        }

        return response()->json(['ok' => 'Data berhasil dihapus!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showBySchoolYear(Request  $request)
    {
        $classRooms = ClassRoom::select(['id', 'name'])->where('school_year_id', $request->school_year_id)->orderBy('class', 'ASC')->orderBy('name', 'ASC')->get();

        return response()->json($classRooms);
    }
}

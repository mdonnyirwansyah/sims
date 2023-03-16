<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\User;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Data Siswa'
        ];

        return view('main.data.student.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData()
    {
        $students = Student::orderBy('registered_at', 'DESC')->get();

        return DataTables::of($students)
        ->addIndexColumn()
        ->editColumn('nis_nisn', function($student) {
            return $student->nis .' / '. $student->nisn;
        })
        ->editColumn('name', function($student) {
            return $student->user->name;
        })
        ->editColumn('class_room', function($student) {
            if ($student->class_rooms()->count() > 0) {
                $classRoom = $student->class_rooms()->latest()->first();
                $studentClassRoom = $classRoom->name;
            } else {
                $studentClassRoom = '-';
            }

            return $studentClassRoom;
        })
        ->editColumn('phone', function($student) {
            return $student->user->address()->count() > 0 ? $student->user->address->phone : '-';
        })
        ->addColumn('action', function ($data) {
            return '
            <a href="'. route("data.student.edit", $data['id']) .'" class="btn btn-outline-info btn-xs mr-1" data-toggle="tooltip" data-placement="top" title="Edit">
                <i class="fa fa-pen"></i>
            </a>
            <button id="'. $data['id']. '" route="'. route("data.student.destroy", $data['id']) .'" onclick="handleDelete('. $data['id'] .')" type="button" class="btn btn-outline-danger btn-xs ml-1" data-toggle="tooltip" data-placement="top" title="Hapus">
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
        $data = [
            'title' => 'Tambah Siswa'
        ];

        return view('main.data.student.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StudentStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentStoreRequest $request)
    {
        $families = collect([]);
        $father = collect($request->father);
        $mother = collect($request->mother);
        $guardian = collect($request->guardian);
        if ($request->guardian['name'] && $request->guardian['occupation'] && $request->guardian['address'] && $request->guardian['phone']) {
            $families->push($father, $mother, $guardian);
        } else {
            $families->push($father, $mother);
        }

        try {
            DB::beginTransaction();

            $userCreated = User::create([
                'role_id' => 3,
                'name' => $request->name,
                'username' => $request->nisn,
                'password' => Hash::make($request->nisn)
            ]);
            $studentCreated = $userCreated->student()->create([
                'nis' => $request->nis,
                'nisn' => $request->nisn,
                'class_at' => $request->class_at,
                'registered_at' => $request->registered_at
            ]);
            if ($request->profile_picture) {
                $profile_picture = md5($request->profile_picture.microtime().'.'.$request->profile_picture->extension());
                Storage::putFileAs(
                    'public/profile-pictures',
                    $request->profile_picture,
                    $profile_picture
                );
            }
            $userCreated->user_detail()->create([
                'place_of_birth' => $request->place_of_birth,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'religion' => $request->religion,
                'profile_picture' => $request->profile_picture ? $profile_picture : null
            ]);
            $userCreated->address()->create([
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->phone
            ]);
            $familiesCreate = [];
            foreach ($families as $index => $family) {
                $familiesCreate[$index] = [
                    'type' => $family['type'],
                    'name' => $family['name'],
                    'occupation' => $family['occupation']
                ];
            }
            $familiesCreated = $studentCreated->families()->createMany($familiesCreate);
            $familiesCreated[0]->address()->create([
                'address' => $request->father['address'],
                'phone' => $request->father['phone']

            ]);
            if ($familiesCreated->count() === 3) {
                $familiesCreated[2]->address()->create([
                    'address' => $request->guardian['address'],
                    'phone' => $request->guardian['phone']
    
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->back()->with('failed', $e->getMessage());
        }

        return redirect()->route('data.student.index')->with('ok', 'Data berhasil ditambah!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $fatherIdentity = $student->families()->where('type', 'Father')->first();
        $fatherAddress = $fatherIdentity ? $fatherIdentity->address()->first() : null;
        $motherIdentity = $student->families()->where('type', 'Mother')->first();
        $guardianIdentity = $student->families()->where('type', 'Guardian')->first();
        $guardianAddress = $guardianIdentity ? $guardianIdentity->address()->first() : null;
        $father = [
            'name' => $fatherIdentity->name ?? '',
            'occupation' => $fatherIdentity->occupation ?? '',
            'address' => $fatherAddress->address ?? '',
            'phone' => $fatherAddress->phone ?? ''
        ];
        $mother = [
            'name' => $motherIdentity->name ?? '',
            'occupation' => $motherIdentity->occupation ?? ''
        ];
        $guardian = [
            'name' => $guardianIdentity->name ?? '',
            'occupation' => $guardianIdentity->occupation ?? '',
            'address' => $guardianAddress->address ?? '',
            'phone' => $guardianAddress->phone ?? ''
        ];
        $data= [
            'title' => 'Edit Siswa',
            'student' => $student,
            'father' => $father,
            'mother' => $mother,
            'guardian' => $guardian
        ];

        return view('main.data.student.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StudentUpdateRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentUpdateRequest $request, Student $student)
    {
        $father = $student->families()->where('type', 'Father')->first();
        $mother = $student->families()->where('type', 'Mother')->first();
        $guardian = $student->families()->where('type', 'Guardian')->first();

        try {
            DB::beginTransaction();

            $student->user()->update([
                'name' => $request->name,
                'username' => $request->nisn,
            ]);
            $student->update([
                'nis' => $request->nis,
                'nisn' => $request->nisn,
                'class_at' => $request->class_at,
                'registered_at' => $request->registered_at
            ]);

            if ($request->profile_picture) {
                if ($student->user->user_detail->profile_picture) {
                    Storage::delete('public/profile-pictures/'.$student->user->user_detail->profile_picture);
                }

                $profile_picture = md5($request->profile_picture.microtime().'.'.$request->profile_picture->extension());
                Storage::putFileAs(
                    'public/profile-pictures',
                    $request->profile_picture,
                    $profile_picture
                );
            }

            $userDetail = [
                'place_of_birth' => $request->place_of_birth,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'religion' => $request->religion,
                'profile_picture' => $profile_picture ?? $student->user->user_detail->profile_picture ?? null
            ];
            $userAddress = [
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->phone
            ];

            if ($student->user->user_detail === null) {
                $student->user->user_detail()->create($userDetail);
            } else {
                $student->user->user_detail()->update($userDetail);
            }

            if ($student->user->address === null) {
                $student->user->address()->create($userAddress);
            } else {
                $student->user->address()->update($userAddress);
            }

            $userFather = [
                'type' => $request->father['type'],
                'name' => $request->father['name'],
                'occupation' => $request->father['occupation']
            ];
            $userMother = [
                'type' => $request->mother['type'],
                'name' => $request->mother['name'],
                'occupation' => $request->mother['occupation']
            ];
            $userGuardian = [
                'type' => $request->guardian['type'],
                'name' => $request->guardian['name'],
                'occupation' => $request->guardian['occupation']
            ];
            $fatherAddress = [
                'address' => $request->father['address'],
                'phone' => $request->father['phone']
            ];
            $guardianAddress = [
                'address' => $request->guardian['address'],
                'phone' => $request->guardian['phone']
            ];

            if (!$father) {
                $fatherCreated = $student->families()->create($userFather);
                $fatherCreated->address()->create($fatherAddress);
            } else {
                $father->update($userFather);
                $father->address()->update($fatherAddress);
            }

            if (!$mother) {
                $student->families()->create($userMother);
            } else {
                $mother->update($userMother);
            }

            if (!$guardian) {
                $guardianCreated = $student->families()->create($userGuardian);
                $guardianCreated->address()->create($guardianAddress);
            } else {
                $guardian->update($userGuardian);
                $guardian->address()->update($guardianAddress);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->back()->with('failed', $e->getMessage());
        }

        return redirect()->route('data.student.index')->with('ok', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        try {
            DB::beginTransaction();
            if ($student->user->user_detail->profile_picture) {
                Storage::delete('public/profile-pictures/'.$student->user->user_detail->profile_picture);
            }
            
            $families = $student->families()->get();
            $families[0]->address()->delete();
            if ($families->count() === 3) {
                $families[2]->address()->delete();
            }
            $student->user->address()->delete();
            $student->user()->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

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
    public function showByClassRoom(Request  $request)
    {
        $classRoom = ClassRoom::find($request->class_room_id);
        $students = $classRoom->students()->with(['user' => function ($query) {
            $query->orderBy('name', 'ASC');
        }])->get();

        $data = [];

        foreach ($students as $index => $student) {
            $data[$index] = [
                'id' => $student->id,
                'name' => $student->user->name
            ];
        }

        return response()->json($data);
    }
}

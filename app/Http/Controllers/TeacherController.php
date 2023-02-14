<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use App\Http\Requests\TeacherStoreRequest;
use App\Http\Requests\TeacherUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Data Guru'
        ];

        return view('main.data.teacher.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData()
    {
        $teachers = Teacher::whereHas('user')->with(['user' => function ($query) {
            $query->orderBy('name', 'ASC');
        }])->get();
        $data = [];

        foreach ($teachers as $index => $teacher) {
            $data[$index] = [
                'id' => $teacher->id,
                'nip' => $teacher->nip,
                'name' => $teacher->user->name,
                'education' => $teacher->education,
                'phone' => $teacher->user->address->phone
            ];
        }

        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($data) {
            return '
            <a href="'. route("data.teacher.edit", $data['id']) .'" class="btn btn-outline-info btn-xs mr-1" data-toggle="tooltip" data-placement="top" title="Edit">
                <i class="fa fa-pen"></i>
            </a>
            <button id="'. $data['id']. '" route="'. route("data.teacher.destroy", $data['id']) .'" onclick="handleDelete('. $data['id'] .')" type="button" class="btn btn-outline-danger btn-xs ml-1" data-toggle="tooltip" data-placement="top" title="Hapus">
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
            'title' => 'Tambah Guru'
        ];

        return view('main.data.teacher.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TeacherStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherStoreRequest $request)
    {

        try {
            DB::beginTransaction();

            $userCreated = User::create([
                'role_id' => 2,
                'name' => $request->name,
                'username' => $request->nip,
                'password' => Hash::make($request->nip)
            ]);
            $teacherCreated = $userCreated->teacher()->create([
                'nip' => $request->nip,
                'education' => $request->education,
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

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->back()->with('failed', $e->getMessage());
        }

        return redirect()->route('data.teacher.index')->with('ok', 'Data berhasil ditambah!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        $data = [
            'title' => 'Tambah Guru',
            'teacher' => $teacher
        ];

        return view('main.data.teacher.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TeacherUpdateRequest  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(TeacherUpdateRequest $request, Teacher $teacher)
    {
        try {
            DB::beginTransaction();

            $teacher->user()->update([
                'role_id' => 3,
                'name' => $request->name,
                'username' => $request->nip,
            ]);
            $teacher->update([
                'nip' => $request->nip,
                'education' => $request->education
            ]);
            if ($request->profile_picture) {
                if ($teacher->user->user_detail->profile_picture) {
                    Storage::delete('public/profile-pictures/'.$teacher->user->user_detail->profile_picture);
                }

                $profile_picture = md5($request->profile_picture.microtime().'.'.$request->profile_picture->extension());
                Storage::putFileAs(
                    'public/profile-pictures',
                    $request->profile_picture,
                    $profile_picture
                );
            }
            $teacher->user->user_detail()->update([
                'place_of_birth' => $request->place_of_birth,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'religion' => $request->religion,
                'profile_picture' => $request->profile_picture ? $profile_picture : $teacher->user->user_detail->profile_picture
            ]);
            $teacher->user->address()->update([
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->phone
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->back()->with('failed', $e->getMessage());
        }

        return redirect()->route('data.teacher.index')->with('ok', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        try {
            DB::beginTransaction();
            if ($teacher->user->user_detail->profile_picture) {
                Storage::delete('public/profile-pictures/'.$teacher->user->user_detail->profile_picture);
            }
            $teacher->user->address()->delete();
            $teacher->user()->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['failed' => $e->getMessage()]);
        }

        return response()->json(['ok' => 'Data berhasil dihapus!']);
    }
}

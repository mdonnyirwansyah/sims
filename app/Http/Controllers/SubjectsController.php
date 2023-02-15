<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectsStoreRequest;
use App\Http\Requests\SubjectsUpdateRequest;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Data Mata Pelajaran'
        ];

        return view('main.data.subjects.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData()
    {
        $subjects = Subjects::orderBy('group', 'ASC')->orderBy('name', 'ASC')->get();

        return DataTables::of($subjects)
        ->addIndexColumn()
        ->addColumn('action', function ($subjects) {
            return '
            <a href="'. route("data.subjects.edit", $subjects['id']) .'" class="btn btn-outline-info btn-xs mr-1" data-toggle="tooltip" data-placement="top" title="Edit">
                <i class="fa fa-pen"></i>
            </a>
            <button id="'. $subjects['id']. '" route="'. route("data.subjects.destroy", $subjects['id']) .'" onclick="handleDelete('. $subjects['id'] .')" type="button" class="btn btn-outline-danger btn-xs ml-1" data-toggle="tooltip" data-placement="top" title="Hapus">
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
            'title' => 'Tambah Mata Pelajaran'
        ];

        return view('main.data.subjects.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SubjectsStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectsStoreRequest $request)
    {
        try {
            Subjects::create([
                'name' => $request->name,
                'group' => $request->group
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }

        return redirect()->route('data.subjects.index')->with('ok', 'Data berhasil ditambah!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function edit(Subjects $subjects)
    {
        $data = [
            'title' => 'Edit Mata Pelajaran',
            'subjects' => $subjects
        ];

        return view('main.data.subjects.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SubjectsUpdateRequest  $request
     * @param  \App\Models\Subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectsUpdateRequest $request, Subjects $subjects)
    {
        try {
            $subjects->update([
                'name' => $request->name,
                'group' => $request->group
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }

        return redirect()->route('data.subjects.index')->with('ok', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subjects $subjects)
    {
        try {
            $subjects->delete();
        } catch (\Exception $e) {
            return response()->json(['failed' => $e->getMessage()]);
        }

        return response()->json(['ok' => 'Data berhasil dihapus!']);
    }
}

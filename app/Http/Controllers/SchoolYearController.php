<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolYearStoreRequest;
use App\Http\Requests\SchoolYearUpdateRequest;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SchoolYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Data Tahun Pelajaran'
        ];

        return view('main.data.school-year.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData()
    {
        $schoolYears = SchoolYear::orderBy('name', 'DESC')->get();

        return DataTables::of($schoolYears)
        ->addIndexColumn()
        ->addColumn('action', function ($schoolYears) {
            return '
            <a href="'. route("data.school-year.edit", $schoolYears['id']) .'" class="btn btn-outline-info btn-xs mr-1" data-toggle="tooltip" data-placement="top" title="Edit">
                <i class="fa fa-pen"></i>
            </a>
            <button id="'. $schoolYears['id']. '" route="'. route("data.school-year.destroy", $schoolYears['id']) .'" onclick="handleDelete('. $schoolYears['id'] .')" type="button" class="btn btn-outline-danger btn-xs ml-1" data-toggle="tooltip" data-placement="top" title="Hapus">
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
            'title' => 'Tambah Tahun Pelajaran'
        ];

        return view('main.data.school-year.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SchoolYearStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SchoolYearStoreRequest $request)
    {
        try {
            SchoolYear::create([
                'name' => $request->name
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }

        return redirect()->route('data.school-year.index')->with('ok', 'Data berhasil ditambah!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolYear $schoolYear)
    {
        $data = [
            'title' => 'Edit Tahun Pelajaran',
            'schoolYear' => $schoolYear
        ];

        return view('main.data.school-year.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SchoolYearStoreRequest  $request
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \Illuminate\Http\Response
     */
    public function update(SchoolYearUpdateRequest $request, SchoolYear $schoolYear)
    {
        try {
            $schoolYear->update([
                'name' => $request->name
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }

        return redirect()->route('data.school-year.index')->with('ok', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolYear $schoolYear)
    {
        try {
            $schoolYear->delete();
        } catch (\Exception $e) {
            return response()->json(['failed' => $e->getMessage()]);
        }

        return response()->json(['ok' => 'Data berhasil dihapus!']);
    }
}

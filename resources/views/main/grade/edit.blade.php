@extends('layouts.main.index')

@section('title', $data['title'])

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $data['title'] }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('grade.index') }}">Penilaian</a></li>
                    <li class="breadcrumb-item active">{{ $data['title'] }}</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div id="failed" class="d-none alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i>Pemberitahuan,</h5>
                    <p id="failed-message"></p>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form id="form-action" class="form-horizontal" action="{{ route('grade.update', $data['report']->id) }}" method="post" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group row">
                                <label for="school_year_id" class="col-sm-3 col-form-label">Tahun Pelajaran <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="school_year_id" name="school_year_id" value="{{ $data['report']->class_room->school_year->name }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="semester" class="col-sm-3 col-form-label">Semester <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="semester" name="semester" value="{{ $data['report']->semester }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="class_room_id" class="col-sm-3 col-form-label">Kelas <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="class_room_id" name="class_room_id" value="{{ $data['report']->class_room->name }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="type" class="col-sm-3 col-form-label">Jenis <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="type" name="type" value="{{ $data['report']->type }}" readonly>
                                    <small class="invalid-feedback type_err"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="student_id" class="col-sm-3 col-form-label">Siswa <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="student_id" name="student_id" value="{{ $data['report']->student->user->name }}" readonly>
                                </div>
                            </div>
                            <div id="subjects">
                                @foreach ($data['report']->grades()->get() as $index => $grade)
                                <div class="form-group row">
                                    <label for="subjects" class="col-sm-3 col-form-label">{{ $grade->subjects->name }} <span class="text-danger">*</span></label>
                                    <input type="hidden" name="subjects[{{ $index }}][id]" value="{{ $grade->id }}">
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control @error('subjects.'.$index.'.value') is-invalid @enderror" id="subjects_{{ $grade->subjects->id }}_value" name="subjects[{{ $index }}][value]" value="{{ old('subjects.'.$index.'.value') ?? $grade->value }}">
                                        @error('subjects.'.$index.'.value')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <textarea id="subjects_{{ $grade->subjects->id }}_description" class="form-control @error('subjects.'.$index.'.description') is-invalid @enderror" id="subjects_{{ $grade->subjects->id }}_description" name="subjects[{{ $index }}][description]">{{ old('subjects.'.$index.'.description') ?? $grade->description }}</textarea>
                                        @error('subjects.'.$index.'.description')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <a href="{{ route('grade.index') }}" class="btn btn-danger float-right ml-2">Batal</a>
                                    <button id="submit-button" type="submit" class="btn btn-primary float-right">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

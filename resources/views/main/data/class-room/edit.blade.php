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
                    <li class="breadcrumb-item"><a href="{{ route('data.class-room.index') }}">Data Kelas</a></li>
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
                @if($message = Session::get('failed'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i>Pemberitahuan,</h5>
                    {{ $message }}
                </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('data.class-room.update', $data['classRoom']->id) }}" method="post" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group row">
                                <label for="school_year" class="col-sm-3 col-form-label">Tahun Pelajaran</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('school_year_id') is-invalid @enderror" id="school_year" value="{{ $data['classRoom']->school_year->name }}" readonly>
                                    <input type="hidden" name="school_year_id" value="{{ $data['classRoom']->school_year->id }}">
                                    @error('school_year_id')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="class" class="col-sm-3 col-form-label">Kelas</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('class') is-invalid @enderror" id="class" name="class" value="{{ $data['classRoom']->class }}" readonly>
                                    @error('class')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Nama Kelas <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') ?? $data['classRoom']->name }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="teacher_id" class="col-sm-3 col-form-label">Wali Kelas</label>
                                <div class="col-sm-9">
                                    <select class="form-control @error('teacher_id') is-invalid @enderror" id="teacher_id" name="teacher_id" value="{{ old('teacher_id') ?? $data['classRoom']->teacher_id }}">
                                        <option disabled>Pilih Wali Kelas</option>
                                        @foreach ($data['teachers'] as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->nip .' - '. $teacher->user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('teacher_id')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <a href="{{ route('data.class-room.index') }}" class="btn btn-danger float-right ml-2">Batal</a>
                                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
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

@extends('layouts.main.index')

@section('title', 'Tambah Jadwal Pelajaran')

@push('javascript')
@if(session()->has('status'))
<script>
  toastr.success("{{ __('Successfully saved!') }}", 'Notification,');
</script>
@endif
@endpush

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Jadwal Pelajaran</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('lesson-schedule.index') }}">Jadwal Pelajaran</a></li>
                    <li class="breadcrumb-item active">Tambah Jadwal Pelajaran</li>
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
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('lesson-schedule.store') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="school_year" class="col-sm-3 col-form-label">Tahun Pelajaran</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('school_year_id') is-invalid @enderror" id="school_year" value="{{ $data['school_year']['name'] }}" readonly>
                                    <input type="hidden" name="school_year_id" value="{{ $data['school_year']['id'] }}">
                                    @error('school_year_id')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="semester" class="col-sm-3 col-form-label">Semester</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('semester') is-invalid @enderror" id="class" value="{{ $data['semester'] }}" readonly>
                                    @error('semester')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="teacher" class="col-sm-3 col-form-label">Guru</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('teacher_id') is-invalid @enderror" id="teacher" value="{{ $data['teacher']['name'] }}" readonly>
                                    <input type="hidden" name="teacher_id" value="{{ $data['teacher']['id'] }}">
                                    @error('teacher_id')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="class_id" class="col-sm-3 col-form-label">Kelas</label>
                                <div class="col-sm-9">
                                    <select class="form-control @error('class_id') is-invalid @enderror" id="class_id" name="class_id">
                                        <option selected disabled>Pilih Kelas</option>
                                        <option value="1">XI IPS 1</option>
                                    </select>
                                    @error('class_id')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="day_id" class="col-sm-3 col-form-label">Hari</label>
                                <div class="col-sm-9">
                                    <select class="form-control @error('day_id') is-invalid @enderror" id="day_id" name="day_id">
                                        <option selected disabled>Pilih Hari</option>
                                    </select>
                                    @error('day_id')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="start_time" class="col-sm-3 col-form-label">Jam Mulai</label>
                                <div class="col-sm-9">
                                    <input type="time" class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time" value="{{ old('start_time') }}">
                                </div>
                                @error('start_time')
                                <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="end_time" class="col-sm-3 col-form-label">Jam Selesai</label>
                                <div class="col-sm-9">
                                    <input type="time" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" value="{{ old('end_time') }}">
                                </div>
                                @error('end_time')
                                <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <a href="{{ route('lesson-schedule.index') }}" class="btn btn-danger float-right ml-2">Batal</a>
                                    <button type="submit" class="btn btn-primary float-right">Submit</button>
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

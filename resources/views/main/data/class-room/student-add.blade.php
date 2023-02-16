@extends('layouts.main.index')

@section('title', $data['title'])

@push('stylesheet')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('javascript')
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('.select2').select2({
      theme: 'bootstrap4'
    });

    var values = {{ $data['classRoomStudents'] }};
    
    $('#students').val(values).change();
});
</script>
@endpush

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header" id="page">
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
                        <form class="form-horizontal" action="{{ route('data.class-room.student-add-store', $data['classRoom']->id) }}" method="post" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group row">
                                <label for="school_year" class="col-sm-3 col-form-label">Tahun Pelajaran</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('school_year') is-invalid @enderror" id="school_year" value="{{ $data['classRoom']->school_year->name }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="class" class="col-sm-3 col-form-label">Kelas</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('class') is-invalid @enderror" id="class" name="class" value="{{ $data['classRoom']->class }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Nama Kelas</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $data['classRoom']->name }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="teacher_id" class="col-sm-3 col-form-label">Wali Kelas</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('teacher') is-invalid @enderror" id="teacher" name="teacher" value="{{ $data['classRoom']->teacher->user->name }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="students" class="col-sm-3 col-form-label">Data Siswa <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control select2 @error('students') is-invalid @enderror" multiple="multiple" data-placeholder="Pilih Siswa" style="width: 100%;" id="students" name="students[]">
                                        @foreach ($data['students'] as $student)
                                            <option value="{{ $student->id }}">{{ $student->nis .' - '. $student->user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('students')
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

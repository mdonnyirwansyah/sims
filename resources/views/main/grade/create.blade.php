@extends('layouts.main.index')

@section('title', 'Tambah Penilaian')

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
                <h1>Tambah Penilaian</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('grade.index') }}">Penilaian</a></li>
                    <li class="breadcrumb-item active">Tambah Penilaian</li>
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
                        <form class="form-horizontal">
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
                                <label for="class" class="col-sm-3 col-form-label">Kelas</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('class_id') is-invalid @enderror" id="class" value="{{ $data['class']['name'] }}" readonly>
                                    <input type="hidden" name="class_id" value="{{ $data['class']['id'] }}">
                                    @error('class_id')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="type" class="col-sm-3 col-form-label">Jenis</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" value="{{ $data['type'] }}" readonly>
                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="student_id" class="col-sm-3 col-form-label">Siswa</label>
                                <div class="col-sm-9">
                                    <select type="text" class="form-control @error('student_id') is-invalid @enderror" id="student_id" name="student_id">
                                        <option selected disabled>Pilih Siswa</option>
                                        <option value="2174">2174 - Ana</option>
                                    </select>
                                    @error('student_id')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="subject" class="col-sm-3 col-form-label">Matematika</label>
                                <input type="hidden" name="subject[]['id']" value="">
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="subject" name="subject[]['score']" placeholder="Nilai">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="subject[]['score']" placeholder="Keterangan"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <a href="{{ route('grade.index') }}" class="btn btn-danger float-right ml-2">Batal</a>
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

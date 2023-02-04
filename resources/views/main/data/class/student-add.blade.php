@extends('layouts.main.index')

@section('title', 'Tambah Siswa')

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
                <h1>Tambah Siswa</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('data.class.index') }}">Data Kelas</a></li>
                    <li class="breadcrumb-item active">Tambah Siswa</li>
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
                        <form class="form-horizontal" action="{{ route('data.class.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="class_id" value="">
                            <div class="form-group row">
                                <label for="school_year" class="col-sm-3 col-form-label">Tahun Pelajaran</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="school_year" value="2022/2023" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="class" class="col-sm-3 col-form-label">Kelas</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="class" value="XI" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Nama Kelas</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" value="XI IPS 1" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="teacher" class="col-sm-3 col-form-label">Wali Kelas</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="teacher" name="teacher" value="198012122003133005 - Bunga, S. Pd.">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="stdents" class="col-sm-3 col-form-label">Data Siswa</label>
                                <div class="col-sm-9">
                                    <select class="form-control @error('stdents') is-invalid @enderror" id="stdents" name="stdents" multiple>
                                        <option selected disabled>Pilih Siswa</option>
                                    </select>
                                    @error('stdents')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <a href="{{ route('data.class.index') }}" class="btn btn-danger float-right ml-2">Batal</a>
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

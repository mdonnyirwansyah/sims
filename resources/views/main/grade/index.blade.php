@extends('layouts.main.index')

@section('title', 'Penilaian')

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
                <h1>Penilaian</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Penilaian</li>
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
                        <form action="{{ route('grade.create') }}" method="get">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                                <!-- /btn-group -->
                                <select class="form-control @error('school_year') is-invalid @enderror" name="school_year">
                                    <option selected disabled>Pilih Tahun Pelajaran</option>
                                    <option value="1|2022/2023">2022/2023</option>
                                </select>
                                <select class="form-control @error('semester') is-invalid @enderror" name="semester">
                                    <option selected disabled>Pilih Semester</option>
                                    <option value="1 (satu)">1 (satu)</option>
                                    <option value="2 (dua)">2 (dua)</option>
                                </select>
                                <select class="form-control @error('class') is-invalid @enderror" name="class">
                                    <option selected disabled>Pilih Kelas</option>
                                    <option value="1|XI IPS 1">XI IPS 1</option>
                                </select>
                                <select class="form-control @error('type') is-invalid @enderror" name="type">
                                    <option selected disabled>Pilih Jenis</option>
                                    <option value="Pengetahuan">Pengetahuan</option>
                                    <option value="Keterampilan">Keterampilan</option>
                                </select>
                            </div>
                        </form>
                        <hr>
                        <div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Tahun Pelajaran</th>
                                        <th>Semester</th>
                                        <th>Kelas</th>
                                        <th>Siswa</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Jenis</th>
                                        <th>Nilai</th>
                                        <th style="width: 40px">Aksi</th>
                                    </tr>
                                </thead>
                                    <tr>
                                        <td>1</td>
                                        <td>2022/2023</td>
                                        <td>2 (dua)</td>
                                        <td>XI IPS 1</td>
                                        <td>2174 - Ana</td>
                                        <td>Matematika</td>
                                        <td>Pengetahuan</td>
                                        <td>80</td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-sm-center justify-content-start">
                                                <a href="#" class="btn btn-outline-info btn-xs mr-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fa fa-pen"></i>
                                                </a>
                                                <button id="" route="" onclick="" type="button" class="btn btn-outline-danger btn-xs ml-1" data-toggle="tooltip" data-placement="top" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </div>
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

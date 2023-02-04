@extends('layouts.main.index')

@section('title', 'Lihat E-Raport')

@push('stylesheet')
    <style>
        #table {
            font-size: 10px;
        }
        #table td, #table th {
            border: 1px solid black;
            padding: 8px;
        }
        #list {
            padding-left: 1rem;
            font-weight: bold;
            font-size: 12px;
        }
    </style>
@endpush

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
                <h1>Lihat E-Raport</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="#">E-Raport</a></li>
                    <li class="breadcrumb-item active">Lihat E-Raport</li>
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
                    <div class="card-header">
                        <form action="{{ route('report.result') }}" method="get">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-primary">Pilih</button>
                                </div>
                                <!-- /btn-group -->
                                <select class="form-control @error('semester') is-invalid @enderror" name="semester">
                                    <option selected disabled>Pilih Semester</option>
                                    <option value="1 (satu)">1 (satu)</option>
                                    <option value="2 (dua)">2 (dua)</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table style="width: 100%; font-size: 12px;">
                            <tbody>
                                <tr>
                                    <td>Nama Sekolah</td>
                                    <td>: </td>
                                    <td>SMA NEGERI 1 BUNUT</td>
                                    <td>Kelas</td>
                                    <td>: </td>
                                    <td>XI IPS 1</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: </td>
                                    <td>Jl. Pelajar No.12 Pangkalan Bunut</td>
                                    <td>Semester</td>
                                    <td>: </td>
                                    <td>2 (dua)</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Tahun Pelajaran</td>
                                    <td>: </td>
                                    <td>2022/2023</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>: </td>
                                    <td>ANA</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Nomor Induk/NISN</td>
                                    <td>: </td>
                                    <td>2174 / 0058213504</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <h1 style="font-size: 14px; text-align: center; font-weight: bold;">CAPAIAN HASIL BELAJAR</h1>
                        <ol id="list" type="A">
                            <li>
                                Pengetahuan
                                <table id="table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Nilai</th>
                                            <th>Predikat</th>
                                            <th>Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="5" style="font-weight: bold">Kelompok A (Umum)</td>
                                        </tr>
                                        <tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Matematika</td>
                                            <td>{{ $value = 80; }}</td>
                                            <td><?php if ($value < 70) {print "D";} else if ($value >= 70 && $value <= 80) {print "C";} else if ($value >= 81 && $value <= 90) {print "B";} else {print "A";} ?></td>
                                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore deserunt tempore magni consequuntur, aperiam ex.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                            <li>
                                Keterampilan
                                <table id="table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Nilai</th>
                                            <th>Predikat</th>
                                            <th>Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="5" style="font-weight: bold">Kelompok A (Umum)</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Matematika</td>
                                            <td>{{ $value = 80; }}</td>
                                            <td><?php if ($value < 70) {print "D";} else if ($value >= 70 && $value <= 80) {print "C";} else if ($value >= 81 && $value <= 90) {print "B";} else {print "A";} ?></td>
                                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore deserunt tempore magni consequuntur, aperiam ex.</td>
                                        </tr>
                                    </tbody>
                                </table>
                                Tabel Interval Predikat Berdasarkan KKM
                                <table id="table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">KKM</th>
                                            <th colspan="4">Predikat</th>
                                        </tr>
                                        <tr>
                                            <th>D</th>
                                            <th>C</th>
                                            <th>B</th>
                                            <th>A</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>70</td>
                                            <td>&lt; 70</td>
                                            <td>70 &le; C &le; 80</td>
                                            <td>81 &le; B &le; 90</td>
                                            <td>91 &le; A &le; 100</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </li>
                        </ol>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary float-right">Cetak</button>
                    </div>
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

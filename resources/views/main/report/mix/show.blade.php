@extends('layouts.main.index')

@section('title', $data['title'])

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
                    <li class="breadcrumb-item"><a href="{{ route('report.index') }}">E-Raport</a></li>
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
                <div class="card">
                    <div class="card-body">
                        <table style="width: 100%; font-size: 12px;">
                            <tbody>
                                <tr>
                                    <td>Nama Sekolah</td>
                                    <td>: </td>
                                    <td>SMA NEGERI 1 BUNUT</td>
                                    <td>Kelas</td>
                                    <td>: </td>
                                    <td>{{ $data['studentData']['class_room'] }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: </td>
                                    <td>Jl. Pelajar No.12 Pangkalan Bunut</td>
                                    <td>Semester</td>
                                    <td>: </td>
                                    <td>{{ $data['studentData']['semester'] }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Tahun Pelajaran</td>
                                    <td>: </td>
                                    <td>{{ $data['studentData']['school_year'] }}</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>: </td>
                                    <td>{{ $data['studentData']['name'] }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Nomor Induk/NISN</td>
                                    <td>: </td>
                                    <td>{{ $data['studentData']['nis_nisn'] }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <h1 style="font-size: 14px; text-align: center; font-weight: bold;">CAPAIAN HASIL BELAJAR</h1>
                        <ol id="list" type="A">
                            @foreach ($data['reports'] as $report)
                            <li>
                                {{ $report->type }}
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
                                        @foreach ($report->grades()->whereRelation('subjects', 'group', 'Kelompok A (Umum)')->get() as $index => $grade)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $grade->subjects->name }}</td>
                                            <td>{{ $value = $grade->value; }}</td>
                                            <td><?php if ($value < 70) {print "D";} else if ($value >= 70 && $value <= 80) {print "C";} else if ($value >= 81 && $value <= 90) {print "B";} else {print "A";} ?></td>
                                            <td>{{ $grade->description }}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="5" style="font-weight: bold">Kelompok B (Umum)</td>
                                        </tr>
                                        @foreach ($report->grades()->whereRelation('subjects', 'group', 'Kelompok B (Umum)')->get() as $index => $grade)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $grade->subjects->name }}</td>
                                            <td>{{ $value = $grade->value; }}</td>
                                            <td><?php if ($value < 70) {print "D";} else if ($value >= 70 && $value <= 80) {print "C";} else if ($value >= 81 && $value <= 90) {print "B";} else {print "A";} ?></td>
                                            <td>{{ $grade->description }}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="5" style="font-weight: bold">Kelompok C (Peminatan)</td>
                                        </tr>
                                        @foreach ($report->grades()->whereRelation('subjects', 'group', 'Kelompok C (Peminatan)')->get() as $index => $grade)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $grade->subjects->name }}</td>
                                            <td>{{ $value = $grade->value; }}</td>
                                            <td><?php if ($value < 70) {print "D";} else if ($value >= 70 && $value <= 80) {print "C";} else if ($value >= 81 && $value <= 90) {print "B";} else {print "A";} ?></td>
                                            <td>{{ $grade->description }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </li>
                            @endforeach
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

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
                    <li class="breadcrumb-item"><a href="{{ route('grade.archive.index') }}">Penilaian</a></li>
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
                        <h2 style="font-size: 1.4rem;">Nilai Pengetahuan</h2>
                        <table id="archives-table" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Nama</th>
                                    <th>Nilai</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data['report']['pengetahuan'] as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->student->user->name }}</td>
                                    <td>{{ $item->grade->value}}</td>
                                    <td>{{ $item->grade->description}}</td>
                                  </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Rekap Nilai Tidak Ditemukan!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <br>
                        <h2 style="font-size: 1.4rem;">Nilai Keterampilan</h2>
                        <table id="archives-table" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Nama</th>
                                    <th>Nilai</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data['report']['keterampilan'] as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->student->user->name }}</td>
                                    <td>{{ $item->grade->value}}</td>
                                    <td>{{ $item->grade->description}}</td>
                                  </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Rekap Nilai Tidak Ditemukan!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
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

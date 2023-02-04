@extends('layouts.main.index')

@section('title', 'Beranda')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Beranda</h1>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="card card-row card-default">
            <div class="card-header bg-info d-flex justify-content-center">
                <h2 class="card-title font-weight-bold">
                    Jadwal Pelajaran
                </h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-light card-outline">
                            <div class="card-header d-flex justify-content-center">
                                <h3 class="card-title font-weight-bold">Senin</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th>Mata Pelajaran</th>
                                        <th>Waktu</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>Matematika</td>
                                        <td>08.00 - 10.00</td>
                                      </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection

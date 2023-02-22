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
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-12">
                <div class="card direct-chat direct-chat-primary collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title">Filter</h3>
        
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-3">
                        <form method="get" >
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                                <!-- /btn-group -->
                                <select class="form-control @error('school_year_id') is-invalid @enderror" id="school_year_id" name="school_year_id">
                                    <option selected disabled>Pilih Tahun Pelajaran</option>
                                    @foreach ($data['schoolYears'] as $schoolYear)
                                        <option value="{{ $schoolYear->id }}">{{ $schoolYear->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!--/.direct-chat -->
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $data['students'] }}</h3>

                        <p>Data Siswa</p>
                    </div>
                    <a href="{{ route('data.student.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $data['classRooms'] }}</h3>

                        <p>Data Kelas</p>
                    </div>
                    <a href="{{ route('data.class-room.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $data['subjects'] }}</h3>

                        <p>Data Mata Pelajaran</p>
                    </div>
                    <a href="{{ route('data.subjects.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $data['teachers'] }}</h3>

                        <p>Data Guru</p>
                    </div>
                    <a href="{{ route('data.teacher.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection

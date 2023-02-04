@extends('layouts.main.index')

@section('title', 'E-Raport')

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
                <h1>E-Raport</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">E-Raport</li>
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
                                <select class="form-control @error('class') is-invalid @enderror" name="class">
                                    <option selected disabled>Pilih Kelas</option>
                                    <option value="1|XI IPS 1">XI IPS 1</option>
                                </select>
                                <select class="form-control @error('semester') is-invalid @enderror" name="semester">
                                    <option selected disabled>Pilih Semester</option>
                                    <option value="1 (satu)">1 (satu)</option>
                                    <option value="2 (dua)">2 (dua)</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-header -->
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

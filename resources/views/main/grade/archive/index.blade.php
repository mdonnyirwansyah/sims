@extends('layouts.main.index')

@section('title', $data['title'])

@push('stylesheet')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<!-- Sweetaler2 -->
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-rowreorder/css/rowReorder.bootstrap4.min.css') }}">
@endpush

@push('javascript')
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Sweetaler2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('.select2').select2({
      theme: 'bootstrap4'
    });
    $('#filter').change(function (e) {
        archives.draw();
        e.preventDefault();
    });
    var archives = $('#archives-table').DataTable({
        processing: true,
        serverSide: true,
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
        rowReorder: true,
        ajax: {
            url: '{{ route('grade.archive.getData') }}',
            type: 'post',
            data: function (d) {
                d.school_year_id = $('#school_year_id').val();
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        columns: [
            {
                data: 'DT_RowIndex',
                width: 50,
                orderable: false,
                searchable: false
            },
            {data: 'school_year', name: 'school_year'},
            {data: 'class_room', name: 'class_room'},
            {data: 'subjects', name: 'subjects'},
            {data: 'semester', name: 'semester'},
            {
                data: 'action',
                name: 'action',
                width: 75,
                orderable: false,
                searchable: false
            }
        ]
    });
});
</script>
@endpush

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $data["title"] }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="breadcrumb-item active"> {{ $data["title"] }}</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <form id="filter">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Filter</span>
                                </div>
                                <!-- /btn-group -->
                                <select class="form-control select2 @error('school_year_id') is-invalid @enderror" id="school_year_id" name="school_year_id">
                                    <option selected disabled>Pilih Tahun Pelajaran</option>
                                    @foreach ($data['schoolYears'] as $schoolYear)
                                        <option value="{{ $schoolYear->id }}">{{ $schoolYear->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <table id="archives-table" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Tahun Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Semester</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

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
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

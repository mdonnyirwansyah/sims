@extends('layouts.main.index')

@section('title', $data['title'])

@push('stylesheet')
<!-- Sweetaler2 -->
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-rowreorder/css/rowReorder.bootstrap4.min.css') }}">
@endpush

@push('javascript')
<!-- Sweetaler2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#filter').change(function (e) {
        classRooms.draw();
        e.preventDefault();
    });
    var classRooms = $('#class-rooms-table').DataTable({
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
            url: '{{ route('data.class-room.getData') }}',
            type: "post",
            data: function (d) {
                d.school_year_id = $('#school_year_id').val();
                d.class = $('#class').val();
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
            {data: 'class', name: 'class'},
            {data: 'name', name: 'name'},
            {data: 'teacher', name: 'teacher'},
            {
                data: 'action',
                name: 'action',
                width: 95,
                orderable: false,
                searchable: false
            }
        ]
    });
});
</script>

<script>
function handleDelete(id) {
    let route = $(`#${id}`).attr('route');
    Swal.fire({
        title: 'Apakah anda yakin?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: route,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.ok) {
                        $('#class-rooms-table').DataTable().draw();
                        toastr.success(response.ok, 'Pemberitahuan,');
                    } 
                    if (response.failed) {
                        $("#alert").removeClass("d-none");
                        $("#failed").append(response.failed);
                    } 
                    if (!response.ok && !response.failed) {
                        toastr.error('Something when wrong...', 'Pemberitahuan,');
                    }
                },
            });
        }
    })
}
</script>

@if($message = Session::get('ok'))
<script>
  toastr.success('{{ $message }}', 'Pemberitahuan,');
</script>
@endif
@endpush

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> {{ $data["title"] }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="breadcrumb-item active"> {{ $data["title"] }}</li>
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
                <div class="alert alert-danger alert-dismissible d-none" id="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i>Pemberitahuan,</h5>
                    <div id="failed"></div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <form id="filter">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-default" disabled>Filter</button>
                                </div>
                                <!-- /btn-group -->
                                <select class="form-control @error('school_year_id') is-invalid @enderror" id="school_year_id" name="school_year_id">
                                    <option selected disabled>Pilih Tahun Pelajaran</option>
                                    @foreach ($data['schoolYears'] as $schoolYear)
                                        <option value="{{ $schoolYear->id }}">{{ $schoolYear->name }}</option>
                                    @endforeach
                                </select>
                                <select class="form-control @error('class') is-invalid @enderror" id="class" name="class">
                                    <option selected disabled>Pilih Kelas</option>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('data.class-room.create') }}" class="btn btn-primary float-right">Tambah</a>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <table id="class-rooms-table" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Tahun Pelajaran</th>
                                        <th>Kelas</th>
                                        <th>Nama Kelas</th>
                                        <th>Wali Kelas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
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

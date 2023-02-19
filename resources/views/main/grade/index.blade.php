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
        grades.draw();
        e.preventDefault();
    });
    var grades = $('#grades-table').DataTable({
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
            url: '{{ route('grade.getData') }}',
            type: 'post',
            data: function (d) {
                d.school_year_id = $('#school_year_id').val();
                d.semester = $('#semester').val();
                d.class_room_id = $('#class_room_id').val();
                d.type = $('#type').val();
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
            {data: 'semester', name: 'semester'},
            {data: 'class_room', name: 'class_room'},
            {data: 'student', name: 'student'},
            {data: 'type', name: 'type'},
            {
                data: 'action',
                name: 'action',
                width: 75,
                orderable: false,
                searchable: false
            }
        ]
    });

    $('#school_year_id').change(function () {
        $('#class_room_id').val(null).trigger('change');
        handleClassRooms();
        $('#semester').prop('disabled', false);
        $('#class_room_id').prop('disabled', false);
        $('#type').prop('disabled', false);
    });
});
</script>

<script>
function handleClassRooms() {
    $('#class_room_id').select2({
        placeholder: 'Pilih Kelas',
        theme: 'bootstrap4',
        ajax: {
            url: '{{ route('data.class-room.show-by-school-year') }}',
            type: 'get',
            data: function (params) {
                var query = {
                    school_year_id: $('#school_year_id').val()
                }
                return query;
            },
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            }
        }
    });
}
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
                        $('#grades-table').DataTable().draw();
                        toastr.success(response.ok, 'Pemberitahuan,');
                    } 
                    if (response.failed) {
                        $('#alert').removeClass('d-none');
                        $('#failed').append(response.failed);
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
                <div class="alert alert-danger alert-dismissible d-none" id="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i>Pemberitahuan,</h5>
                    <div id="failed"></div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <form id="filter">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-default">Filter</button>
                                </div>
                                <!-- /btn-group -->
                                <select class="form-control select2 @error('school_year_id') is-invalid @enderror" id="school_year_id" name="school_year_id">
                                    <option selected disabled>Pilih Tahun Pelajaran</option>
                                    @foreach ($data['schoolYears'] as $schoolYear)
                                        <option value="{{ $schoolYear->id }}">{{ $schoolYear->name }}</option>
                                    @endforeach
                                </select>
                                <select class="form-control select2 @error('semester') is-invalid @enderror"  id="semester" name="semester" disabled>
                                    <option selected disabled>Pilih Semester</option>
                                    <option value="1 (satu)">1 (satu)</option>
                                    <option value="2 (dua)">2 (dua)</option>
                                </select>
                                <select class="form-control select2 @error('class_room_id') is-invalid @enderror" id="class_room_id" name="class_room_id" disabled>
                                    <option selected disabled>Pilih Kelas</option>
                                </select>
                                <select class="form-control select2 @error('type') is-invalid @enderror"  id="type" name="type" disabled>
                                    <option selected disabled>Pilih Jenis</option>
                                    <option value="Pengetahuan">Pengetahuan</option>
                                    <option value="Keterampilan">Keterampilan</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('grade.create') }}" class="btn btn-primary float-right">Tambah</a>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <table id="grades-table" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Semester</th>
                                        <th>Kelas</th>
                                        <th>Siswa</th>
                                        <th>Jenis</th>
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
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

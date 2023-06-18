@extends('layouts.main.index')

@section('title', $data['title'])

@push('stylesheet')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('javascript')
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('.select2').select2({
      theme: 'bootstrap4'
    });
    $('#school_year_id').change(function () {
        $('#class_room_id').val(null).trigger('change');
        handleClassRooms();
        $('#semester').prop('disabled', false);
        $('#class_room_id').prop('disabled', false);
        $('#type').prop('disabled', false);
    });
    $('#class_room_id').change(function () {
        $('#student_id').val(null).trigger('change');
        handleStudents();
        handleSubjects();
        $('#student_id').prop('disabled', false);
    });
    $('#form-action').submit(function (e) {
        e.preventDefault();
        $('#submit-button').prop('disabled', true);

        $.ajax({
            url: $(this).attr('action'),
            type: 'post',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.ok) {
                    toastr.success(response.ok, 'Pemberitahuan,');
                    async function redirect() {
                        let promise = new Promise(function (resolve, reject) {
                            setTimeout(function () {
                                resolve('{{ route("grade.input.index") }}');
                            }, 3000);
                        });
                        window.location.href = await promise;
                    }
                    redirect();
                } else if (response.error) {
                    printErrorMsg(response.error);
                    $('#submit-button').prop('disabled', false);
                } else if (response.exist) {
                    toastr.error(response.exist, 'Pemberitahuan,');
                    $('#submit-button').prop('disabled', false);
                } else {
                    $('#failed').removeClass('d-none');
                    $('#failed-message').empty();
                    $('#failed-message').append(response.failed);
                    $('#submit-button').prop('disabled', false);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
                $('#submit-button').prop('disabled', false);
            }
        });
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
function handleStudents() {
    $('#student_id').select2({
        placeholder: 'Pilih Siswa',
        theme: 'bootstrap4',
        ajax: {
            url: '{{ route('data.student.show-by-class-room') }}',
            type: 'get',
            data: function (params) {
                var query = {
                    class_room_id: $('#class_room_id').val()
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
function handleSubjects() {
    $.ajax({
        url: '{{ route('data.subjects.show-by-class-room') }}',
        type: 'get',
        data: {
            'class_room_id' : $('#class_room_id').val()
        },
        dataType: 'json',
        success: function (response) {
            if (response.length > 0) {
                $('#subjects').empty();
                $.each(response, function (key, value) {
                    $('#subjects').append(`<div class="form-group row"><label for="subjects" class="col-sm-3 col-form-label">${value.name} <span class="text-danger">*</span></label><input type="hidden" name="subjects[${value.id}][subjects_id]" value="${value.id}"><div class="col-sm-9"><input type="number" class="form-control" id="subjects_${key}_value" name="subjects[${value.id}][value]" placeholder="Nilai"><small class="invalid-feedback subjects_${key}_value_err"></small></div></div><div class="form-group row"><label class="col-sm-3 col-form-label"></label><div class="col-sm-9"><textarea id="subjects_${key}_description" class="form-control" id="subjects_${key}_description" name="subjects[${value.id}][description]" placeholder="Keterangan"></textarea><small class="invalid-feedback subjects_${key}_description_err"></small></div></div>`);
                });
            }
            if (response.length === 0) {
                $('#subjects').empty();
            }
            if (!response.length > 0 && !response.length === 0) {
                toastr.error('Something when wrong...', 'Pemberitahuan,');
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
        }
    });
}
function printErrorMsg (msg) {
    $.each(msg, function (key, value) {
        var key = key.replace(/[^a-zA-Z0-9]/g, '_');
        $('#'+key).addClass('is-invalid');
        $('.'+key+'_err').text(value);
        $('#'+key+'_err').text(value);
        $('#'+key).change(function () {
            $('#'+key).removeClass('is-invalid');
        });
    });
}
</script>
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
                    <li class="breadcrumb-item"><a href="{{ route('grade.input.index') }}">Penilaian</a></li>
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
                <div id="failed" class="d-none alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i>Pemberitahuan,</h5>
                    <p id="failed-message"></p>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form id="form-action" class="form-horizontal" action="{{ route('grade.input.store') }}" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label for="school_year_id" class="col-sm-3 col-form-label">Tahun Pelajaran <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" id="school_year_id" name="school_year_id">
                                        <option selected disabled>Pilih Tahun Pelajaran</option>
                                        @foreach ($data['schoolYears'] as $schoolYear)
                                            <option value="{{ $schoolYear->id }}">{{ $schoolYear->name }}</option>
                                        @endforeach
                                    </select>
                                    <small class="invalid-feedback school_year_id_err"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="semester" class="col-sm-3 col-form-label">Semester <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" id="semester" name="semester" disabled>
                                        <option selected disabled>Pilih Semester</option>
                                        <option value="1 (satu)">1 (satu)</option>
                                        <option value="2 (dua)">2 (dua)</option>
                                    </select>
                                    <small class="invalid-feedback semester_err"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="class_room_id" class="col-sm-3 col-form-label">Kelas <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" id="class_room_id" name="class_room_id" disabled>
                                        <option selected disabled>Pilih Kelas</option>
                                    </select>
                                    <small class="invalid-feedback class_room_id_err"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="type" class="col-sm-3 col-form-label">Jenis <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" id="type" name="type" disabled>
                                        <option selected disabled>Pilih Jenis</option>
                                        <option value="Pengetahuan">Pengetahuan</option>
                                        <option value="Keterampilan">Keterampilan</option>
                                    </select>
                                    <small class="invalid-feedback type_err"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="student_id" class="col-sm-3 col-form-label">Siswa <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" id="student_id" name="student_id" disabled>
                                        <option selected disabled>Pilih Siswa</option>
                                    </select>
                                    <small class="invalid-feedback student_id_err"></small>
                                </div>
                            </div>
                            <div id="subjects">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <a href="{{ route('grade.input.index') }}" class="btn btn-danger float-right ml-2">Batal</a>
                                    <button id="submit-button" type="submit" class="btn btn-primary float-right">Submit</button>
                                </div>
                            </div>
                        </form>
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

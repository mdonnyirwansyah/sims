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
        handleClassRooms();
        $('#semester').prop('disabled', false);
        $('#class_room_id').prop('disabled', false);
        $('#type').prop('disabled', false);
    });
    $('#school_year_id').change(function () {
        handleStudents();
    });
    $('#class_room_id').change(function () {
        handleSubjects();
        $('#student_id').prop('disabled', false);
    });
});
</script>

<script>
function handleClassRooms() {
    $('#class_room_id').select2({
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
                    $('#subjects').append(`<div class="form-group row"><label for="subject" class="col-sm-3 col-form-label">${value.name} <span class="text-danger">*</span></label><input type="hidden" name="subjects[${value.id}][\'id\']" value="${value.id}"><div class="col-sm-9"><input type="number" class="form-control" id="subject" name="subjects[${value.id}][\'value\']" placeholder="Nilai"></div></div><div class="form-group row"><label class="col-sm-3 col-form-label"></label><div class="col-sm-9"><textarea class="form-control" name="subjects[${value.id}][\'description\']" placeholder="Keterangan"></textarea></div></div>`);
                });
            } 
            if (response.length === 0) {
                $('#subjects').empty();
            } 
            if (!response.length > 0 && !response.length === 0) {
                toastr.error('Something when wrong...', 'Pemberitahuan,');
            }
        }
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
                    <li class="breadcrumb-item"><a href="{{ route('grade.index') }}">Penilaian</a></li>
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
                @if($message = Session::get('failed'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i>Pemberitahuan,</h5>
                    {{ $message }}
                </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('grade.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="school_year_id" class="col-sm-3 col-form-label">Tahun Pelajaran <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control select2 @error('school_year_id') is-invalid @enderror" id="school_year_id" name="school_year_id">
                                        <option selected disabled>Pilih Tahun Pelajaran</option>
                                        @foreach ($data['schoolYears'] as $schoolYear)
                                            <option value="{{ $schoolYear->id }}">{{ $schoolYear->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('school_year_id')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="semester" class="col-sm-3 col-form-label">Semester <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control select2 @error('semester') is-invalid @enderror" id="semester" name="semester" disabled>
                                        <option selected disabled>Pilih Semester</option>
                                        <option value="1 (satu)">1 (satu)</option>
                                        <option value="2 (dua)">2 (dua)</option>
                                    </select>
                                    @error('semester')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="class_room_id" class="col-sm-3 col-form-label">Kelas <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select type="text" class="form-control select2 @error('class_room_id') is-invalid @enderror" id="class_room_id" name="class_room_id" disabled>
                                        <option selected disabled>Pilih Kelas</option>
                                        @foreach ($data['classRooms'] as $classRoom)
                                            <option value="{{ $classRoom->id }}">{{ $classRoom->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('class_room_id')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="type" class="col-sm-3 col-form-label">Jenis <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control select2 @error('type') is-invalid @enderror" id="type" name="type" disabled>
                                        <option selected disabled>Pilih Jenis</option>
                                        <option value="Pengetahuan">Pengetahuan</option>
                                        <option value="Keterampilan">Keterampilan</option>
                                    </select>
                                    @error('semester')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="student_id" class="col-sm-3 col-form-label">Siswa <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control select2 @error('student_id') is-invalid @enderror" id="student_id" name="student_id" disabled>
                                        <option selected disabled>Pilih Siswa</option>
                                    </select>
                                    @error('student_id')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div id="subjects">
                                {{-- <div class="form-group row">
                                    <label for="subject" class="col-sm-3 col-form-label">Matematika <span class="text-danger">*</span></label>
                                    <input type="hidden" name="subject[]['id']" value="">
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="subject" name="subject[]['score']" placeholder="Nilai">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="subject[]['score']" placeholder="Keterangan"></textarea>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <a href="{{ route('grade.index') }}" class="btn btn-danger float-right ml-2">Batal</a>
                                    <button type="submit" class="btn btn-primary float-right">Submit</button>
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

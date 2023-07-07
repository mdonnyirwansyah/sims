@extends('layouts.main.index')

@section('title', $data['title'])

@push('javascript')
<!-- Select2 -->
<script>
$(document).ready(function() {
    $('#form-action-pengetahuan').submit(function (e) {
        e.preventDefault();
        $('#submit-button').prop('disabled', true);

        var url = $(this).attr('action');
        var formData = new FormData(this);

        save(url, formData);
    });
    $('#form-action-keterampilan').submit(function (e) {
        e.preventDefault();
        $('#submit-button').prop('disabled', true);

        var url = $(this).attr('action');
        var formData = new FormData(this);

        save(url, formData);
    });
});
</script>

<script>
function save(url, formData) {
    $.ajax({
        url: url,
        type: 'post',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.ok) {
                toastr.success('Data berhasil disimpan!', 'Pemberitahuan,');
                async function redirect() {
                    let promise = new Promise(function (resolve, reject) {
                        setTimeout(function () {
                            resolve('{{ route("grade.archive.index") }}');
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
                    <li class="breadcrumb-item"><a href="{{ route('grade.archive.index') }}">Rekap Penilaian</a></li>
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
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#tab-pengetahuan" data-toggle="tab">Pengetahuan</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab-keterampilan" data-toggle="tab">Keterampilan</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="tab-pengetahuan">
                                @if ($data['report']['pengetahuan']->count() > 0)
                                <form id="form-action-pengetahuan" class="form-horizontal" action="{{ route('grade.input.storeSubjects') }}" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label for="school_year_id" class="col-sm-3 col-form-label">Tahun Pelajaran <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="school_year_id" name="school_year_id" readonly>
                                                <option value="{{ $data['lesson_schedule']->school_year->id }}">{{ $data['lesson_schedule']->school_year->name }}</option>
                                            </select>
                                            <small class="invalid-feedback school_year_id_err"></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="semester" class="col-sm-3 col-form-label">Semester <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="semester" name="semester" readonly>
                                                <option value="{{ $data['lesson_schedule']->semester }}">{{ $data['lesson_schedule']->semester }}</option>
                                            </select>
                                            <small class="invalid-feedback semester_err"></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="subjects_id" class="col-sm-3 col-form-label">Mata Pelajaran <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="subjects_id" name="subjects_id" readonly>
                                                <option value="{{ $data['lesson_schedule']->class_room_id . ' | ' .$data['lesson_schedule']->subjects->id }}">{{ $data['lesson_schedule']->class_room->name . ' | ' .$data['lesson_schedule']->subjects->name }}</option>
                                            </select>
                                            <small class="invalid-feedback subjects_id_err"></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="type" class="col-sm-3 col-form-label">Jenis <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="type" name="type" readonly>
                                                <option value="Pengetahuan">Pengetahuan</option>
                                            </select>
                                            <small class="invalid-feedback type_err"></small>
                                        </div>
                                    </div>
                                    @foreach ($data['report']['pengetahuan'] as $index => $item)
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">{{ $item->student->user->name }} <span class="text-danger">*</span></label>
                                        <input type="hidden" name="students[{{ $index }}][id]" value="{{ $item->student->id }}">
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="students_{{ $index }}_value" name="students[{{ $index }}][value]" placeholder="Nilai" value="{{ $item->grade?->value }}">
                                            <small class="invalid-feedback students_{{ $index }}_value_err"></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <textarea id="students_{{ $index }}_description" class="form-control" id="students_{{ $index }}_description" name="students[{{ $index }}][description]" placeholder="Keterangan">{{ $item->grade?->description }}</textarea>
                                            <small class="invalid-feedback students_{{ $index }}_description_err"></small>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <a href="{{ route('grade.archive.index') }}" class="btn btn-danger float-right ml-2">Batal</a>
                                            <button id="submit-button" type="submit" class="btn btn-primary float-right">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                                @else
                                <div class="alert alert-warning alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-exclamation-triangle"></i>Data Rekap Nilai Tidak Ditemukan.</h5>
                                </div>
                                @endif
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab-keterampilan">
                                @if ($data['report']['keterampilan']->count() > 0)
                                <form id="form-action-keterampilan" class="form-horizontal" action="{{ route('grade.input.storeSubjects') }}" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label for="school_year_id" class="col-sm-3 col-form-label">Tahun Pelajaran <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="school_year_id" name="school_year_id" readonly>
                                                <option value="{{ $data['lesson_schedule']->school_year->id }}">{{ $data['lesson_schedule']->school_year->name }}</option>
                                            </select>
                                            <small class="invalid-feedback school_year_id_err"></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="semester" class="col-sm-3 col-form-label">Semester <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="semester" name="semester" readonly>
                                                <option value="{{ $data['lesson_schedule']->semester }}">{{ $data['lesson_schedule']->semester }}</option>
                                            </select>
                                            <small class="invalid-feedback semester_err"></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="subjects_id" class="col-sm-3 col-form-label">Mata Pelajaran <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="subjects_id" name="subjects_id" readonly>
                                                <option value="{{ $data['lesson_schedule']->class_room_id . ' | ' .$data['lesson_schedule']->subjects->id }}">{{ $data['lesson_schedule']->class_room->name . ' | ' .$data['lesson_schedule']->subjects->name }}</option>
                                            </select>
                                            <small class="invalid-feedback subjects_id_err"></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="type" class="col-sm-3 col-form-label">Jenis <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="type" name="type" readonly>
                                                <option value="Keterampilan">Keterampilan</option>
                                            </select>
                                            <small class="invalid-feedback type_err"></small>
                                        </div>
                                    </div>
                                    @foreach ($data['report']['keterampilan'] as $index => $item)
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">{{ $item->student->user->name }}</label>
                                        <input type="hidden" name="students[{{ $index }}][id]" value="{{ $item->student->id }}">
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="students_{{ $index }}_value" name="students[{{ $index }}][value]" placeholder="Nilai" value="{{ $item->grade?->value }}">
                                            <small class="invalid-feedback students_{{ $index }}_value_err"></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <textarea id="students_{{ $index }}_description" class="form-control" id="students_{{ $index }}_description" name="students[{{ $index }}][description]" placeholder="Keterangan">{{ $item->grade?->description }}</textarea>
                                            <small class="invalid-feedback students_{{ $index }}_description_err"></small>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <a href="{{ route('grade.archive.index') }}" class="btn btn-danger float-right ml-2">Batal</a>
                                            <button id="submit-button" type="submit" class="btn btn-primary float-right">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                                @else
                                <div class="alert alert-warning alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-exclamation-triangle"></i>Data Rekap Nilai Tidak Ditemukan.</h5>
                                </div>
                                @endif
                            </div>
                            <!-- /.tab-pane -->
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

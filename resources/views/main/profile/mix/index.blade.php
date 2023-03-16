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
    @if ($data['user']->user_detail !== null) 
        $('#gender').val("{{ $data['user']->user_detail->gender }}").change();
        $('#religion').val("{{ $data['user']->user_detail->religion }}").change();
    @endif
    $('#form-address').submit(function (e) {
        e.preventDefault();
        $('#submit-address-button').prop('disabled', true);

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
                } else if (response.error) {
                    printErrorMsg(response.error);
                    $('#submit-address-button').prop('disabled', false);
                } else {
                    $('#failed-address').removeClass('d-none');
                    $('#failed-address-message').empty();
                    $('#failed-address-message').append(response.failed);
                    $('#submit-address-button').prop('disabled', false);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
                $('#submit-address-button').prop('disabled', false);
            }
        });
    });
    $('#form-password').submit(function (e) {
        e.preventDefault();
        $('#submit-password-button').prop('disabled', true);

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
                } else if (response.error) {
                    printErrorMsg(response.error);
                    $('#submit-password-button').prop('disabled', false);
                } else {
                    $('#failed-password').removeClass('d-none');
                    $('#failed-password-message').empty();
                    $('#failed-password-message').append(response.failed);
                    $('#submit-password-button').prop('disabled', false);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
                $('#submit-password-button').prop('disabled', false);
            }
        });
    });
});
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
                <h1>Profil</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
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
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" @if ($data['user']->user_detail()->count() > 0) src="{!! $data['user']->user_detail->profile_picture ? asset('storage/profile-pictures/'.  $data['user']->user_detail->profile_picture) : asset('dist/img/profile-picture.png') !!}" @else src="{{ asset('dist/img/profile-picture.png') }}" @endif alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $data['user']->name }}</h3>

                        <p class="text-muted text-center">{{ $data['user']->teacher->nip }}</p>

                        <a class="btn btn-danger btn-block" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                          </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#tab-identity" data-toggle="tab">Identitas</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab-address" data-toggle="tab">Alamat</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab-account" data-toggle="tab">Akun</a></li>
                        </ul>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="tab-identity">
                                @if($message = Session::get('failed'))
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i>Pemberitahuan,</h5>
                                    {{ $message }}
                                </div>
                                @endif
                                <form class="form-horizontal" action="{{ route('profile.update', $data['user']->id) }}" method="post" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">Nama <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') ?? $data['user']->name ?? '' }}">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nip" class="col-sm-3 col-form-label">NIP @if ($data['user']->role->name === 'Administrator') <span class="text-danger">*</span> @endif</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" value="{{ old('nip') ?? $data['user']->teacher->nip ?? '' }}" @if ($data['user']->role->name !== 'Administrator') readonly @endif>
                                            @error('nip')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="place_of_birth" class="col-sm-3 col-form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror" id="place_of_birth" name="place_of_birth" value="{{ old('place_of_birth') ?? $data['user']->user_detail->place_of_birth ?? '' }}">
                                            @error('place_of_birth')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="date_of_birth" class="col-sm-3 col-form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') ?? $data['user']->user_detail->date_of_birth ?? '' }}">
                                            @error('date_of_birth')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="gender" class="col-sm-3 col-form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-control select2 @error('gender') is-invalid @enderror" id="gender" name="gender" value="{{ $data['user']->user_detail->gender ?? '' }}">
                                                <option selected disabled>Pilih Jenis Kelamin</option>
                                                <option value="Male">Laki-laki</option>
                                                <option value="Female">Perempuan</option>
                                            </select>
                                            @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="religion" class="col-sm-3 col-form-label">Agama <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-control select2 @error('religion') is-invalid @enderror" id="religion" name="religion" value="{{ old('religion') ?? $data['user']->user_detail->gender ?? '' }}">
                                                <option selected disabled>Pilih Agama</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Budha">Budha</option>
                                                <option value="Kong Hu Chu">Kong Hu Chu</option>
                                            </select>
                                            @error('religion')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="education" class="col-sm-3 col-form-label">Pendidikan <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('education') is-invalid @enderror" id="education" name="education" value="{{ old('education') ?? $data['user']->teacher->education ?? '' }}">
                                            @error('education')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="profile_picture" class="col-sm-3 col-form-label">Foto Profil</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control @error('profile_picture') is-invalid @enderror" id="profile_picture" name="profile_picture">
                                            @error('profile_picture')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-3 col-sm-9">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab-address">
                                <div id="failed-address" class="d-none alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i>Pemberitahuan,</h5>
                                    <p id="failed-message"></p>
                                </div>
                                <form id="form-address" class="form-horizontal" action="{{ route('profile.update-address', $data['user']->id) }}" method="post">
                                    @method('put')
                                    <div class="form-group row">
                                        <label for="address" class="col-sm-3 col-form-label">Alamat <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" id="address" name="address">{{ $data['user']->address->address ?? '' }}</textarea>
                                            <small class="invalid-feedback address_err"></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label">Email <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" id="email" name="email" value="{{ $data['user']->address->email ?? '' }}">
                                            <small class="invalid-feedback email_err"></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-3 col-form-label">No. HP <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $data['user']->address->phone ?? '' }}">
                                            <small class="invalid-feedback phone_err"></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-3 col-sm-9">
                                            <button type="submit" id="submit-address-button" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="tab-account">
                                <form id="form-password" class="form-horizontal" action="{{ route('profile.update-account', $data['user']->id) }}" method="post">
                                    @method('put')
                                    <div class="form-group row">
                                        <label for="current_password" class="col-sm-3 col-form-label">Password Sekarang <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="current_password" name="current_password">
                                            <small class="invalid-feedback current_password_err"></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="new_password" class="col-sm-3 col-form-label">Password Baru <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="new_password" name="new_password">
                                            <small class="invalid-feedback new_password_err"></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="new_password_confirmation" class="col-sm-3 col-form-label">Konfirmasi Password Baru<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                                            <small class="invalid-feedback new_password_confirmation_err"></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-3 col-sm-9">
                                            <button type="submit" id="submit-password-button" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
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

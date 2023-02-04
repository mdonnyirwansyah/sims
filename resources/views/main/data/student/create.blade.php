@extends('layouts.main.index')

@section('title', 'Tambah Siswa')

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
                <h1>Tambah Siswa</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('data.student.index') }}">Data Siswa</a></li>
                    <li class="breadcrumb-item active">Tambah Siswa</li>
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
                    <div class="card-body">
                        <form class="form-horizontal">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-form-label pb-0">
                                            <h2 class="card-title font-weight-bold text-muted">Identitas Peserta Didik</h2>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">Nama</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nis" class="col-sm-3 col-form-label">NIS</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis" name="nis">
                                            @error('nis')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nisn" class="col-sm-3 col-form-label">NISN</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn" name="nisn">
                                            @error('nisn')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="date_of_birth" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth">
                                            @error('date_of_birth')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="place_of_birth" class="col-sm-3 col-form-label">Tempat Lahir</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror" id="place_of_birth" name="place_of_birth">
                                            @error('place_of_birth')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="gender" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-9">
                                            <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender"></select>
                                            @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="religion" class="col-sm-3 col-form-label">Agama</label>
                                        <div class="col-sm-9">
                                            <select class="form-control @error('religion') is-invalid @enderror" id="religion" name="religion"></select>
                                            @error('religion')
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
                                        <div class="col-sm-12 col-form-label pb-0">
                                            <h2 class="card-title font-weight-bold text-muted">Diterima di sekolah ini</h2>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="class_at" class="col-sm-3 col-form-label">Di Kelas</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('class_at') is-invalid @enderror" id="class_at" name="class_at">
                                            @error('class_at')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="register_at" class="col-sm-3 col-form-label">Pada Tanggal</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control @error('register_at') is-invalid @enderror" id="register_at" name="register_at">
                                            @error('register_at')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-form-label pb-0">
                                            <h2 class="card-title font-weight-bold text-muted">Alamat Peserta Didik</h2>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="address" class="col-sm-3 col-form-label">Alamat</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address"></textarea>
                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-3 col-form-label">No. HP</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone">
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-form-label pb-0">
                                            <h2 class="card-title font-weight-bold text-muted">Nama Orang Tua</h2>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="father_name" class="col-sm-3 col-form-label">Ayah</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('father_name') is-invalid @enderror" id="father_name" name="father_name">
                                            @error('father_name')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="mother_name" class="col-sm-3 col-form-label">Ibu</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('mother_name') is-invalid @enderror" id="mother_name" name="mother_name">
                                            @error('mother_name')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-form-label pb-0">
                                            <h2 class="card-title font-weight-bold text-muted">Pekerjaan Orang Tua</h2>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="father_occupation" class="col-sm-3 col-form-label">Ayah</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('father_occupation') is-invalid @enderror" id="father_occupation" name="father_occupation">
                                            @error('father_occupation')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="mother_occupation" class="col-sm-3 col-form-label">Ibu</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('mother_occupation') is-invalid @enderror" id="mother_occupation" name="mother_occupation">
                                            @error('mother_occupation')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-form-label pb-0">
                                            <h2 class="card-title font-weight-bold text-muted">Alamat Orang Tua</h2>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="parents_address" class="col-sm-3 col-form-label">Alamat</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control @error('parents_address') is-invalid @enderror" id="parents_address" name="parents_address"></textarea>
                                            @error('parents_address')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="parents_phone" class="col-sm-3 col-form-label">No. HP</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('parents_phone') is-invalid @enderror" id="parents_phone" name="parents_phone">
                                            @error('parents_phone')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-form-label pb-0">
                                            <h2 class="card-title font-weight-bold text-muted">Wali</h2>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="guardian_name" class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('guardian_name') is-invalid @enderror" id="guardian_name" name="guardian_name">
                                            @error('guardian_name')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="guardian_occupation" class="col-sm-3 col-form-label">Pekerjaan</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('guardian_occupation') is-invalid @enderror" id="guardian_occupation" name="guardian_occupation">
                                            @error('date_of_birth')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="guardian_address" class="col-sm-3 col-form-label">Alamat</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control @error('guardian_address') is-invalid @enderror" id="guardian_address" name="guardian_address"></textarea>
                                            @error('guardian_address')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="guardian_phone" class="col-sm-3 col-form-label">No. HP</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('guardian_phone') is-invalid @enderror" id="guardian_phone" name="guardian_phone">
                                            @error('guardian_phone')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <a href="{{ route('data.student.index') }}" class="btn btn-danger float-right ml-2">Batal</a>
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

@extends('layouts.main.index')

@section('title', 'Profil')

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
                <h1>Profil</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Profil</li>
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
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('dist/img/profile-picture.png') }}"
                                alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">User</h3>

                        <p class="text-muted text-center">---</p>

                        <a href="#" class="btn btn-danger btn-block"><b>Logout</b></a>
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
                            <li class="nav-item"><a class="nav-link active" href="#identity" data-toggle="tab">Identitas</a></li>
                            <li class="nav-item"><a class="nav-link" href="#address" data-toggle="tab">Alamat</a></li>
                            <li class="nav-item"><a class="nav-link" href="#parents" data-toggle="tab">Orang Tua</a></li>
                            <li class="nav-item"><a class="nav-link" href="#guardian" data-toggle="tab">Wali</a></li>
                            <li class="nav-item"><a class="nav-link" href="#account" data-toggle="tab">Akun</a></li>
                        </ul>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="identity">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-form-label pb-0">
                                            <h2 class="card-title font-weight-bold text-muted">Identitas</h2>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">Nama</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name" name="name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nis" class="col-sm-3 col-form-label">NIS</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="nis" name="nis">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nisn" class="col-sm-3 col-form-label">NISN</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="nisn" name="nisn">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="date_of_birth" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="place_of_birth" class="col-sm-3 col-form-label">Tempat Lahir</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="place_of_birth" name="place_of_birth">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="ganeder" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="ganeder" name="ganeder"></select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="religion" class="col-sm-3 col-form-label">Agama</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="religion" name="religion"></select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="profile_picture" class="col-sm-3 col-form-label">Foto Profil</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" id="profile_picture" name="profile_picture">
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
                                            <input type="text" class="form-control" id="class_at" name="class_at">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="register_date" class="col-sm-3 col-form-label">Pada Tanggal</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" id="register_date" name="register_date">
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
                            <div class="tab-pane" id="address">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="address" class="col-sm-3 col-form-label">Alamat</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" id="address" name="address"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" id="email" name="email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-3 col-form-label">No. HP</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="phone" name="phone">
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

                            <div class="tab-pane" id="parents">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-form-label pb-0">
                                            <h2 class="card-title font-weight-bold text-muted">Nama</h2>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="father_name" class="col-sm-3 col-form-label">Ayah</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="father_name" name="father_name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="mother_name" class="col-sm-3 col-form-label">Ibu</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="mother_name" name="mother_name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-form-label pb-0">
                                            <h2 class="card-title font-weight-bold text-muted">Pekerjaan</h2>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="father_occupation" class="col-sm-3 col-form-label">Ayah</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="father_occupation" name="father_occupation">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="mother_occupation" class="col-sm-3 col-form-label">Ibu</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="mother_occupation" name="mother_occupation">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-form-label pb-0">
                                            <h2 class="card-title font-weight-bold text-muted">Alamat</h2>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="parents_address" class="col-sm-3 col-form-label">Alamat</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" id="parents_address" name="parents_address"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="parents_phone" class="col-sm-3 col-form-label">No. HP</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="parents_phone" name="parents_phone">
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

                            <div class="tab-pane" id="guardian">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="guardian_name" class="col-sm-3 col-form-label">Nama</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="guardian_name" name="guardian_name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="guardian_occupation" class="col-sm-3 col-form-label">Pekerjaan</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="guardian_occupation" name="guardian_occupation">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="guardian_address" class="col-sm-3 col-form-label">Alamat</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" id="guardian_address" name="guardian_address"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="guardian_phone" class="col-sm-3 col-form-label">No. HP</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="guardian_phone" name="guardian_phone">
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

                            <div class="tab-pane" id="account">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="current_password" class="col-sm-3 col-form-label">Password Sekarang</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="current_password" name="current_password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="new_password" class="col-sm-3 col-form-label">Password Baru</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="new_password" name="new_password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="confirm_password" class="col-sm-3 col-form-label">Konfirmasi Password</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="confirm_password" name="confirm_password">
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

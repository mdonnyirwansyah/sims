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
    @isset($data['student']->user->user_detail)
    $('#gender').val("{{ $data['student']->user->user_detail->gender }}").change();
    $('#religion').val("{{ $data['student']->user->user_detail->religion }}").change();
    @endisset
});
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
                    <li class="breadcrumb-item"><a href="{{ route('data.student.index') }}">Data Siswa</a></li>
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
                        <form class="form-horizontal" action="{{ route('data.student.update', $data['student']->id) }}" method="post" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-form-label pb-0">
                                            <h2 class="card-title font-weight-bold text-muted">Identitas Peserta Didik</h2>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">Nama <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') ?? $data['student']->user->name }}">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nis" class="col-sm-3 col-form-label">NIS <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis" name="nis" value="{{ old('nis') ?? $data['student']->nis }}">
                                            @error('nis')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nisn" class="col-sm-3 col-form-label">NISN <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn" name="nisn" value="{{ old('nisn') ?? $data['student']->nisn }}">
                                            @error('nisn')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="place_of_birth" class="col-sm-3 col-form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror" id="place_of_birth" name="place_of_birth" value="{{ old('place_of_birth') ?? $data['student']->user->user_detail->place_of_birth ?? '' }}">
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
                                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') ?? $data['student']->user->user_detail->date_of_birth ?? '' }}">
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
                                            <select class="form-control select2 @error('gender') is-invalid @enderror" id="gender" name="gender" value="{{ $data['student']->user->user_detail->gender ?? '' }}">
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
                                            <select class="form-control select2 @error('religion') is-invalid @enderror" id="religion" name="religion" value="{{ old('religion') ?? $data['student']->user->user_detail->religion ?? '' }}">
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
                                        <label for="profile_picture" class="col-sm-3 col-form-label">Foto Profil</label>
                                        @if (isset($data['student']->user->user_detail->profile_picture))
                                        <div class="col-sm-4">
                                            <img class="img-fluid" src="{{ asset('storage/profile-pictures/'. $data['student']->user->user_detail->profile_picture) }}" alt="Foto Profil">
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="file" class="form-control @error('profile_picture') is-invalid @enderror" id="profile_picture" name="profile_picture">
                                            @error('profile_picture')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                        @else
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control @error('profile_picture') is-invalid @enderror" id="profile_picture" name="profile_picture">
                                            @error('profile_picture')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-form-label pb-0">
                                            <h2 class="card-title font-weight-bold text-muted">Diterima di sekolah ini</h2>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="class_at" class="col-sm-3 col-form-label">Di Kelas <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('class_at') is-invalid @enderror" id="class_at" name="class_at" value="{{ old('class_at') ?? $data['student']->class_at }}">
                                            @error('class_at')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="registered_at" class="col-sm-3 col-form-label">Pada Tanggal <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control @error('registered_at') is-invalid @enderror" id="registered_at" name="registered_at" value="{{ old('registered_at') ?? $data['student']->registered_at }}">
                                            @error('registered_at')
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
                                        <label for="address" class="col-sm-3 col-form-label">Alamat <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address">{{ old('address') ?? $data['student']->user->address->address ?? '' }}</textarea>
                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label">Email <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') ?? $data['student']->user->address->email ?? '' }}">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-3 col-form-label">No. HP <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') ?? $data['student']->user->address->phone ?? '' }}">
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
                                    <input type="hidden" name="father[type]" value="Father">
                                    <div class="form-group row">
                                        <label for="father_name" class="col-sm-3 col-form-label">Ayah <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('father.name') is-invalid @enderror" id="father_name" name="father[name]" value="{{ old('father.name') ?? $data['father']['name'] ?? '' }}">
                                            @error('father.name')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <input type="hidden" name="mother[type]" value="Mother">
                                    <div class="form-group row">
                                        <label for="mother_name" class="col-sm-3 col-form-label">Ibu <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('mother.name') is-invalid @enderror" id="mother_name" name="mother[name]" value="{{ old('mother.name') ?? $data['mother']['name'] ?? '' }}">
                                            @error('mother.name')
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
                                        <label for="father_occupation" class="col-sm-3 col-form-label">Ayah <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('father.occupation') is-invalid @enderror" id="father_occupation" name="father[occupation]" value="{{ old('father.occupation') ?? $data['father']['occupation'] ?? '' }}">
                                            @error('father.occupation')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="mother_occupation" class="col-sm-3 col-form-label">Ibu <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('mother.occupation') is-invalid @enderror" id="mother_occupation" name="mother[occupation]" value="{{ old('mother.occupation') ?? $data['mother']['occupation'] ?? '' }}">
                                            @error('mother.occupation')
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
                                        <label for="father_address" class="col-sm-3 col-form-label">Alamat <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control @error('father.address') is-invalid @enderror" id="father_address" name="father[address]">{{ old('father.address') ?? $data['father']['address'] ?? '' }}</textarea>
                                            @error('father.address')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="father_phone" class="col-sm-3 col-form-label">No. HP <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('father.phone') is-invalid @enderror" id="father_phone" name="father[phone]" value="{{ old('father.phone') ?? $data['father']['phone'] ?? '' }}">
                                            @error('father.phone')
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
                                    <input type="hidden" name="guardian[type]" value="Guardian">
                                    <div class="form-group row">
                                        <label for="guardian_name" class="col-sm-3 col-form-label">Nama {!! $data['guardian']['name'] ? '<span class="text-danger">*</span>' : null !!}</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('guardian.name') is-invalid @enderror" id="guardian_name" name="guardian[name]" value="{{ old('guardian.name') ?? $data['guardian']['name'] ?? '' }}">
                                            @error('guardian.name')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="guardian_occupation" class="col-sm-3 col-form-label">Pekerjaan {!! $data['guardian']['occupation'] ? '<span class="text-danger">*</span>' : null !!}</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('guardian.occupation') is-invalid @enderror" id="guardian_occupation" name="guardian[occupation]" value="{{ old('guardian.occupation') ?? $data['guardian']['occupation'] ?? '' }}">
                                            @error('guardian.occupation')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="guardian_address" class="col-sm-3 col-form-label">Alamat {!! $data['guardian']['address'] ? '<span class="text-danger">*</span>' : null !!}</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control @error('guardian.address') is-invalid @enderror" id="guardian_address" name="guardian[address]">{{ old('guardian.address') ?? $data['guardian']['address'] ?? '' }}</textarea>
                                            @error('guardian.address')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="guardian_phone" class="col-sm-3 col-form-label">No. HP {!! $data['guardian']['phone'] ? '<span class="text-danger">*</span>' : null !!}</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('guardian.phone') is-invalid @enderror" id="guardian_phone" name="guardian[phone]" value="{{ old('guardian.phone') ?? $data['guardian']['phone'] ?? '' }}">
                                            @error('guardian.phone')
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
                                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
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

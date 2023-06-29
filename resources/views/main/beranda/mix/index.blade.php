@extends('layouts.main.index')

@section('title', $data['title'])

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
    let searchParams = new URLSearchParams(window.location.search);
    if (searchParams.get('semester')) {
        $('#semester').val(searchParams.get('semester'))
    }

    $('#schedule-form').change(function () {
        var form = new FormData(this)
        window.location.replace(`{{ route('beranda') }}?semester=${form.get('semester')}`)
    })
});
</script>
@endpush

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $data['title'] }}</h1>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="card card-row card-default">
            <div class="card-header bg-info d-flex justify-content-center">
                <div class="card-title">
                    <h2 class="font-weight-bold">
                        Jadwal Pelajaran
                    </h2>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <form id="schedule-form" method="get">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Semester</span>
                                </div>
                                <select name="semester" id="semester" class="form-control">
                                    <option selected disabled>Pilih Semester</option>
                                    <option value="1 (satu)">1 (satu)</option>
                                    <option value="2 (dua)">2 (dua)</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    @forelse ($data['lessonSchedules'] as $lessonSchedule)
                    <div class="col-md-4">
                        <div class="card card-light card-outline">
                            <div class="card-header d-flex justify-content-center">
                                <h3 class="card-title font-weight-bold">{{ $lessonSchedule['day'] }}</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th>Mata Pelajaran</th>
                                        <th>Kelas</th>
                                        <th>Waktu</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lessonSchedule['schedules'] as $schedule)
                                        <tr>
                                            <td>{{ $schedule['subjects'] }}</td>
                                            <td>{{ $schedule['classroom'] }}</td>
                                            <td>{{ $schedule['time'] }}</td>
                                          </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-md-12">
                        <p class="text-center">Silahkan Pilih Semester! / Jadwal Pelajaran Tidak Ditemukan!</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection

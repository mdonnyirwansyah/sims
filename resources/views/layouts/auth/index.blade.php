@extends('layouts.index')

@section('body')
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#">{{ config('app.name') }}</a>
        </div>
        <!-- /.login-card-body -->
        @yield('content')
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- Custom Javascript -->
    @stack('javascript')
</body>
@endsection

@extends('layouts.auth.index')

@section('title', 'Login')

@section('content')
<div class="card">
    <div class="card-body login-card-body">
        <h3 class="login-box-msg">{{ __('Login') }}</h3>


        <form method="POST" action="{{ route('login') }}" autocomplete="off">
            @csrf
            <div class="form-group">
                <label for="email" class="control-label">{{ __('Email') }}</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <small>{{ $message }}</small>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password" class="control-label">{{ __('Password') }}</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <small>{{ $message }}</small>
                </span>
                @enderror
            </div>
            <div class="row">
                <div class="col-12">
                  <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
                </div>
              </div>
        </form>
    </div>
</div>
@endsection

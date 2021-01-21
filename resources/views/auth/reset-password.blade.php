@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<div class="container mt-5">

    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                <img src="https://ui-avatars.com/api/?name={{ config('app.name') }}&background=fff&color=6777ef&size=100"
                    alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            @if (session('status'))
            <div class="alert alert-info alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    {{ session('status') }}
                </div>
            </div>
            @endif

            <div class="card card-primary">
                <div class="card-header">
                    <h4>@lang('Reset Password')</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="form-group">
                            <label for="email">@lang('Email')</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" tabindex="1"
                                value="{{ old('email', $request->email) }}" readonly>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">@lang('Password')</label>
                            <input id="password" type="password" class="form-control pwstrength @error('password') is-invalid @enderror"
                                data-indicator="pwindicator" name="password" tabindex="2" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                            <div id="pwindicator" class="pwindicator">
                                <div class="bar"></div>
                                <div class="label"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">@lang('Confirm Password')</label>
                            <input id="password_confirmation" type="password" class="form-control"
                                name="password_confirmation" tabindex="2" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                @lang('Reset Password')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

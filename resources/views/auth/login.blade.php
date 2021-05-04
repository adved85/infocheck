@extends('layouts.app')

@section('content')
<!-- AuthenticatesUsers -->

@if ($blocked_msg = session('blocked_msg'))
<div class="alert alert-danger alert-block text-center">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $blocked_msg }}</strong>
</div>
@endif

<div class="card-body shadow-lg" style="padding:40px; margin:40px auto; max-width: 400px;min-height:52.1%">

        <form method="POST" action="{{ route('login', app()->getLocale()) }}">
                @csrf



        <h3>{{ __('login.Login') }}</h3>

        <div class="col_full">

        <input id="email" type="email" placeholder="{{ __('login.E-Mail Address') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}  not-dark" name="email" value="{{ old('email') }}" required autofocus  >

        @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
        </div>
        <div class="col_full">
       <label for="password" ></label>
        <input id="password"  placeholder="{{ __('login.Password') }}" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} not-dark" name="password" required>

        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
        </div>
        <div class="center col_full nobottommargin">
        <button type="submit"  class="btn btn-secondary"> {{ __('login.Login') }}</button>
        <a href="{{ url('/login/facebook') }}" class="button button-rounded si-facebook si-colored" style=" padding-top: 7px">Facebook</a>

        @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request', app()->getLocale()) }}">
            {{ __('login.Forgot Your Password?') }}
        </a>
        @endif
        </div>
        </form>

        </div>

@endsection

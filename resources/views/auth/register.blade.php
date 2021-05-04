@extends('layouts.app')

@section('content')
<div class="container" style="margin: 11% auto;">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-sm-12">
            <div class="card" style="min-height:44vh">
                <div class="card-header h4 shadow-lg">{{ __('register.Register') }}</div>

                <div class="card-body shadow-lg">
                    <form method="POST" action="{{ route('register', app()->getLocale()) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('register.Name') }}</label>

                            <div class="col-md-6" style="padding:0">
                                <input id="name" type="text" class=" form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('register.E-Mail Address') }}</label>

                            <div class="col-md-6" style="padding:0" >

                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('register.Password') }}</label>

                            <div class="col-md-6" style="padding:0">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('register.Confirm Password') }}</label>

                            <div class="col-md-6" style="padding:0">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-7 offset-md-4">
                                <button type="submit" class="btn btn-secondary">
                                    {{ __('register.Register') }}
                                </button>
                                <a href="{{ url('/login/facebook') }}" class="button button-rounded si-facebook si-colored" style=" padding-top: 7px">Facebook</a>

                            </div>
                        </div>
                        <div class="form-group">
                            {{-- <div class="col-md-6 col-md-offset-4">
                                <a href="{{ url('/login/facebook') }}" class="btn btn-facebook" class="btn btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>
                            </div> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-12">
            {{-- <blockquote class="topmargin bottommargin"> --}}
            <div class="bottommargin">
                <p>{{trans('text.reg_text1')}}<br/>{{trans('text.reg_text2')}}</p>
            </div>
        </div>
    </div>
</div>
@endsection

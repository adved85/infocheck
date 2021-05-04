@extends('layouts.app')

@section('content')
<!-- RegistersUsers -->

<div class="form-widget" style="min-height:65%">
        <div class="row"  style="padding: 20px;margin-top:40px">
        <div class="col-lg-4 shadow-lg">
            <center>
        <h3 style="padding-top:12px">{{trans('text.regi')}}</h3></center>
        <form method="POST" action="{{ route('register', app()->getLocale()) }}">
                @csrf

        <div class="form-process"></div>
        <div class="w-100"></div>
        <div class="col-12 form-group">

        <input id="name" type="text" placeholder="{{ __('register.Name') }}" class="effect-6 form-control{{ $errors->has('name') ? ' is-invalid' : '' }}  required valid" name="name" value="{{ old('name') }}" required autofocus >
        <span class="focus-border">
                <i></i>
        </span>

        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
        </div>
        <div class="col-12 form-group">

        <input id="email" type="email"  placeholder="{{ __('register.E-Mail Address') }}" class="effect-6 form-control{{ $errors->has('email') ? ' is-invalid' : '' }} required valid" name="email" value="{{ old('email') }}" required>
        <span class="focus-border">
                            <i></i>
            </span>
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
        </div>

        <div class="col-12 form-group">

        <input id="password" type="password" placeholder="{{ __('register.Password') }}" class="effect-6  form-control{{ $errors->has('password') ? ' is-invalid' : '' }} required valid" name="password" required>
        <span class="focus-border">
                <i></i>
        </span>
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
         </div>
        <div class="col-12 form-group">

        <input id="password-confirm" type="password" placeholder="{{ __('register.Confirm Password') }}" class="effect-6 form-control required valid" name="password_confirmation" required>
        <span class="focus-border">
                <i></i>
        </span>

    </div>






        <div class="col-12 hidden">
        <input type="text" id="realestate-enquiry-botcheck" name="realestate-enquiry-botcheck" value="">
        </div>
        <div class="col-12 center col_full ">
        <button type="submit" class="btn btn-secondary">  {{ __('register.Register') }}</button>
        <a href="{{ url('/login/facebook') }}" class="button button-rounded si-facebook si-colored" style=" padding-top: 7px">Facebook</a>

        </div><br/>

        </form>
        </div>
        <div class="col-lg-7 offset-lg-1">
        <blockquote class="topmargin bottommargin">
            <p>{{trans('text.reg_text1')}}<br/>{{trans('text.reg_text2')}}</p>
        </blockquote>
        <div class="col_full nobottommargin">

        </div>

        <div class="clear"></div>
        </div>
        </div>
        </div>



@endsection

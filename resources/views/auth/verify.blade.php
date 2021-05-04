 {{-- auth-verify --}}
@extends('layouts.subscribe')

@section('content')
<div class="wrap-verify" style="min-height:65vh">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-5 text-center shadow-lg">
                    <div class="card-header" style="background-color: #0f1841;color: white;">
                        {{ __('verify.Verify Your Email Address') }}
                    </div>

                    <div class="card-body p-5 shadow bg-white rounded">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('verify.A fresh verification link has been sent to your email address') }}
                            </div>
                        @endif

                        {{ __('verify.Before proceeding, please check your email for a verification link') }}
                        {{ __('verify.If you did not receive the email') }}, <a href="{{ route('verification.resend', app()->getLocale()) }}">{{ __('verify.click here to request another') }}</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

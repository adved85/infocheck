@extends('admin.layouts.admin')

@section('title', 'Users')

@section('lang_menu')
@include('admin.includes.menu2', ['langs'=>$langs, 'id'=>$user->id])
@endsection

@section('content')

@include('admin.common.errors')
@include('admin.common.oneerror')
@include('admin.common.success')

<div class="text-left">
        <em>
            <a href="{{ route('admin.user.index', app()->getLocale())}}">Users</a>
            /{{$user->id}}/Email
        </em>
    </div>

<div class="user-list-section card">
    <h3 class="card-header">New Email for User №-{{$user->id}}</h3>

    <div class="card-body">

        <form action="{{ route( 'admin.email.send',['locale' =>app()->getLocale()]  )}}" method="POST" >
            @csrf



                <div class="form-group row">
                    <label for="email-from-name" class="col-sm-3 col-form-label col-form-label-lg">From Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="from_name" id="email-from-name" value="{{config('mail.from.name')}}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email-from-email" class="col-sm-3 col-form-label col-form-label-lg">From Address</label>
                    <div class="col-sm-9">
                        <input type="text" name="from_email" id="email-from-email" value="{{config('mail.from.address')}}" class="form-control">
                    </div>
                </div>
                <hr>



                <div class="form-group row">
                    <label for="email-user-name" class="col-sm-3 col-form-label col-form-label-lg">User Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="email-user-name" value="{{$user->name}}" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email-user-email" class="col-sm-3 col-form-label col-form-label-lg">User Address</label>
                    <div class="col-sm-9">
                        <input type="text" name="email" id="email-user-email" value="{{$user->email}}" class="form-control" readonly>
                        {{-- <textarea name="body" id="email-user-email" cols="30" rows="5" class="form-control"></textarea> --}}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email-subject" class="col-sm-3 col-form-label col-form-label-lg">Subject</label>
                    <div class="col-sm-9">
                        <input type="text" name="subject" id="email-subject"  class="form-control" placeholder="Mail Subject ..." value="My Subject">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email_body" class="col-sm-3 col-form-label col-form-label-lg">Message</label>
                    <div class="col-sm-9">
                        <textarea name="body" id="email_body" cols="30" rows="5" class="form-control" placeholder="Mail message here ...">My mail-message</textarea>
                    </div>
                </div>



                <input type="text" name="id" value="{{$user->id}}" hidden>
                <input type="text" name="template_type" value="custom" hidden>
                <input type="text" name="template" value="admin.emails.send" hidden>

                <button type="submit" class="btn btn-outline-primary btn-lg">Send Email</button>

        </form>

    </div>
</div>

@endsection

@extends('admin.layouts.admin')

@section('title', 'Languages')

@section('lang_menu')
@include('admin.includes.menu', $langs)
@endsection

@section('content')

@include('admin.common.errors')
@include('admin.common.oneerror')
@include('admin.common.success')

<div class="text-left">
    <em>
        <a href="{{ route('admin.lang.index', app()->getLocale())}}">Languages</a>
        / Create</em>
</div>


<div class="create-lang-section card">
    <h3 class="card-header">Create new Language №-{{$last_id}}</h3>


    <div class="card-body">
        <form action="{{route('admin.lang.store', app()->getLocale())}}" method="POST" id="lang_create_form">
            @csrf

            <div class="form-group row">
                <label for="create-lang-id" class="col-sm-2 col-form-label col-form-label-lg text-left">ID</label>
                <div class="col-sm-10">
                    <input type="text" name="id" id="create-lang-id" class="form-control" value="{{$last_id}}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="create-lang-lng" class="col-sm-2 col-form-label col-form-label-lg text-left">Code (lng)</label>
                <div class="col-sm-10">
                    <input type="text" name="lng" id="create-lang-lng" class="form-control" value="{{ old('lng') }}" >
                </div>
            </div>

            <div class="form-group row">
                <label for="create-lang-lng_root" class="col-sm-2 col-form-label col-form-label-lg text-left">Name's Root</label>
                <div class="col-sm-10">
                    <input type="text" name="lng_root" id="create-lang-lng_root" class="form-control" value="{{ old('lng_root') }}" >
                </div>
            </div>

            <div class="form-group row">
                <label for="create-lang-lng_name" class="col-sm-2 col-form-label col-form-label-lg text-left">Language Name</label>
                <div class="col-sm-10">
                    <input type="text" name="lng_name" id="create-lang-lng_name" class="form-control" value="{{ old('lng_name') }}" >
                </div>
            </div>

            <code>
                As default, new Language is in "disabled" status.
            </code>

            <div class="card-footer">
                <input type="text" name="id" id="create-lang-id" class="form-control" value="{{$last_id}}" hidden>
                <button type="submit" class="btn btn-primary btn-lg px-5"> Create</button>
            </div>
    </div>
</div>

@endsection

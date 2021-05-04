@extends('admin.layouts.admin')

@section('title', 'Posts')

@section('lang_menu')
{{-- @include('admin.includes.menu', $langs) --}}
@endsection

@section('content')

@include('admin.common.errors')
@include('admin.common.oneerror')
@include('admin.common.success')

<div class="text-left">
    <em>
        <a href="{{ route('admin.category.index', app()->getLocale())}}">Categories</a>
        /{{$currentCat->id}}/translate <code>{{$currentCat->name}}</code></em>
</div>

<div class="create-post-section card">
        <h3 class="card-header">
            Translate Category N-{{$currentCat->id}}/{{$currentCat->item_id}}/<code>{{app()->getLocale()}}</code>
        </h3>

        {{-- ['item_id','name', 'position', 'layout', 'status','lang_id']; --}}
        <form class="py-3 px-5" action="{{ route('admin.category.storetrans',['locale'=>app()->getLocale()] ) }}" method="POST">
                @csrf

                <div class="cart-body">

                    <div class="form-group row">
                        <label for="trans-item-id" class="col-sm-3 col-form-label col-form-label-lg">Item ID</label>
                        <div class="col-sm-9">
                            <input type="text" name="item_id" class="form-control" id="trans-item-id" value="{{$currentCat->item_id}}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="trans-cat-lng-name" class="col-sm-3 col-form-label col-form-label-lg">Language</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="trans-cat-lng-name" value="{{$lang->lng_name}}" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="trans-cat-position" class="col-sm-3 col-form-label col-form-label-lg">Position</label>
                        <div class="col-sm-9">
                            <input type="text" name="position" class="form-control" id="trans-cat-position" value="{{$currentCat->position}}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="trans-cat-name" class="col-sm-3 col-form-label col-form-label-lg" >Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" id="trans-cat-name" value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="trans-cat-layout" class="col-sm-3 col-form-label col-form-label-lg" >Layout</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="layout" id="trans-cat-layout" value="{{ $currentCat->layout }}" readonly>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="trans-cat-status" class="col-sm-3 col-form-label col-form-label-lg" >Status /{{app()->getLocale()}}</label>
                        <div class="col-sm-9">
                            {{-- <input type="text" class="form-control" name="status" id="edit-cat-status" value="{{$category->status}}"> --}}
                            <select name="status" class="form-control" id="trans-cat-status">
                                <option value="1" >Show</option>
                                <option value="0" >Hide</option>
                            </select>
                        </div>
                    </div>

                    <h3 class="col-sm-12 col-form-label col-form-label-lg text-center" >Posts Design Of This Category-group On Main Page (layout)</h3>
                    <div class="d-flex" style="justify-content: center;">
                        <div class="card" style="width: 18rem;">
                            <img src="{{asset('/storage/postclasses/A.png')}}" class="card-img-top" alt="A.png">
                            <div class="card-body">
                                <h4 class="card-text">class A</h4>
                            </div>
                        </div>
                        <div class="card" style="width: 18rem;">
                            <img src="{{asset('/storage/postclasses/B.png')}}" class="card-img-top" alt="B.png">
                            <div class="card-body">
                                <h4 class="card-text">class B</h4>
                            </div>
                        </div>
                        <div class="card" style="width: 18rem;">
                            <img src="{{asset('/storage/postclasses/D.png')}}" class="card-img-top" alt="C.png">
                            <div class="card-body">
                                <h4 class="card-text">class C</h4>
                            </div>
                        </div>
                        <div class="card" style="width: 18rem;">
                            <img src="{{asset('/storage/postclasses/C.png')}}" class="card-img-top" alt="D.png">
                            <div class="card-body">
                                <h4 class="card-text">class D</h4>
                            </div>
                        </div>
                    </div>
                </div> <!-- div class="cart-body"-->


                <div class="card-footer">
                        <input type="text" name="lang_id" class="form-control" id="trans-cat-lang_id" value="{{$lang->id}}" hidden>
                        <button type="submit" class="btn btn-primary btn-lg px-4">Create</button>
                </div>
        </form>



@endsection

@extends('admin.layouts.admin')

@section('title', 'Posts')

@section('lang_menu')
@include('admin.includes.menu2', ['langs'=> $langs, $about])
@endsection

@section('content')

{{-- @include('admin.common.errors') --}}
<!-- here Errors and imgDebug -->
@include('admin.common.imgMessages')
@include('admin.common.oneerror')
@include('admin.common.success')

<div class="edit-about-section card">
        <h3 class="card-header">Edit About Us/<code>{{$about->lang->lng}}</code></h3>


        <dvi class="card-body">


                <form action="{{route('admin.document.uploadimage', app()->getLocale())}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="about-imgs-upload d-flex flex-row rounded border border-success py-2">

                        <div class="btn-group">
                            <input type="file" name="images[]" id="images" multiple="multiple" class="btn btn-light">
                            <input type="text" hidden name="unique_id" value="1">
                            <input type="text" hidden name="folder_name" id="" value="{{$folder_name}}">
                        </div>
                        <div class="btn-group ml-3">
                            <button type="submit" class="btn btn-success">Upload Images</button>
                        </div>
                    </div>
                </form>
                <hr>

                @isset($imageurls)
                <table  class="table table-bordered table-striped table-hover table-condensed" style="font-size:14px">
                    <thead>
                        <th>url</th>
                        <th>image</th>
                        <th>size: kb</th>
                    </thead>
                    <tbody>
                    @for ($i = 0; $i < count($imageurls); $i++)
                    <tr>
                        <td><span>{{ $imageurls[$i]['url'] }}</span></td>
                        <td><img src="{{$imageurls[$i]['url']}}" alt="" width="120px"></td>
                        <td><span>{{$imageurls[$i]['size']}}</span></td>
                    </tr>
                    @endfor
                    </tbody>
                </table>
                @endisset


                <form action="{{route('admin.about.update', ['locale' => app()->getLocale(), $about])}}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label for="about-edit-id" class="col-sm-2 col-form-label col-form-label-lg">ID</label>
                            <div class="col-sm-10">
                                <input type="text" name="id" class="form-control" id="about-edit-id" value="{{$about->id}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="html_code" class="col-sm-2 col-form-label col-form-label-lg">Body</label>
                            <div class="col-sm-10">
                                <textarea name="html_code" id="html_code" rows="5" class="form-control">{{$about->html_code}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lang-edit-status" class="col-sm-2 col-form-label col-form-label-lg">Status</label>
                            <div class="col-sm-10">
                                {{-- <input type="text" name="status" class="form-control" id="lang-edit-status" value="{{$current->lng_name}}" > --}}
                                <select name="status" class="form-control" id="lang-edit-status">
                                    <option value="0" @if ($about->status === 0) selected @endif >Disable</option>
                                    <option value="1" @if ($about->status === 1) selected @endif >Enable</option>
                                </select>
                            </div>
                        </div>

                        <hr>
                        <button type="submit" class="btn btn-outline-dark btn-lg" >Update About Us</button>
                    </form>


        </dvi>

</div>
@endsection

@extends('admin.layouts.admin')

@section('title', 'Posts')

@section('lang_menu')
{{-- @include('admin.includes.menu', $langs) --}}
@endsection

@section('content')

{{-- @include('admin.common.errors') --}}
<!-- here Errors and imgDebug -->
@include('admin.common.imgMessages')
@include('admin.common.oneerror')
@include('admin.common.success')

@isset($tags)
<script>
    let tags = @json($tags);
    console.log(tags);
</script>
@endisset


<div class="text-left">
    <em>
        <a href="{{ route('admin.post.index', app()->getLocale())}}">Posts</a>
        /{{$post->id}}/Edit
    </em>
</div>

<div class="post-edit-section card">
    <h3 class="card-header">Edit Post №-{{$post->id}}/{{$post->unique_id}}</h3>



    <div class="card-body">

            <!-- Upload Image Form -->
            <form action="{{route('admin.document.uploadimage', app()->getLocale())}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="create-post-imgs-upload d-flex flex-row rounded border border-success py-2">

                    <div class="btn-group">
                        <input type="file" name="images[]" id="images" multiple="multiple" class="btn btn-light">
                        <input type="text" hidden name="unique_id" value="{{$post->unique_id}}">
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

            <form action="{{route('admin.post.update', ['locale'=>app()->getLocale(), $post])}}" method="POST" id="post_update_form">
                @csrf
                {{ method_field('put') }}

                <h4 class="bg-light text-left p-2 border rounded">Content/ <code>{{app()->getLocale()}}</code> </h4>

                <div class="form-group row">
                    <label for="post-edit-category" class="col-sm-2 col-form-label col-form-label-lg text-left">Category</label>
                    <div class="col-sm-10">
                        <select name="category_id" id="post-edit-category" class="form-control">
                            @foreach ($categories as $item)
                                @if ($item->id === $post->category_id)
                                    <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                @else
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="edit-post-unique" class="col-sm-2 col-form-label col-form-label-lg text-left">Unique</label>
                    <div class="col-sm-10">
                        <input type="text" name="unique_id" id="edit-post-unique" class="form-control" value="{{$post->unique_id}}" disabled>
                    </div>
                </div>

                <div class="form-group row">
                        <label for="edit-post-title" class="col-sm-2 col-form-label col-form-label-lg text-left">Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" id="edit-post-title" class="form-control" value="{{$post->title}}">
                        </div>
                    </div>

                <div class="form-group row">
                    <label for="short_text" class="col-sm-2 col-form-label col-form-label-lg text-left">Short text</label>
                    <div class="col-sm-10">
                        <textarea type="text" name="short_text" id="short_text" class="form-control" rows="5">
                            {{$post->short_text}}
                        </textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="html_code" class="col-sm-2 col-form-label col-form-label-lg text-left">HTML code</label>
                    <div class="col-sm-10">
                        <textarea type="text" name="html_code" id="html_code" class="form-control" rows="5">
                            {{$post->html_code}}
                        </textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="edit-post-image" class="col-sm-2 col-form-label col-form-label-lg text-left">Post image</label>
                    <div class="col-sm-10">
                        <input type="text" name="img" id="edit-post-image" class="form-control" value="{{$post->img}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="edit-post-meta-k" class="col-sm-2 col-form-label col-form-label-lg text-left">Meta-keys</label>
                    <div class="col-sm-10">
                        <input type="text" name="meta_k" id="edit-post-meta-k" class="form-control" value="{{$post->meta_k}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="edit-post-meta-d" class="col-sm-2 col-form-label col-form-label-lg text-left">Meta-description</label>
                    <div class="col-sm-10">
                        <input type="text" name="meta_d" id="edit-post-meta-d" class="form-control" value="{{$post->meta_d}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="edit-post-view" class="col-sm-2 col-form-label col-form-label-lg text-left">View</label>
                    <div class="col-sm-10">
                        <input type="text" name="view" id="edit-post-view" class="form-control" value="{{$post->view}}" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="edit-post-lang-id" class="col-sm-2 col-form-label col-form-label-lg text-left">Language</label>
                    <div class="col-sm-10">
                        {{-- <input type="text" name="view" id="edit-post-lang-id" class="form-control" value="{{$post->view}}" disabled> --}}
                        <select name="lang_id" id="edit-post-lang-id" class="form-control" disabled>
                            @foreach ($langs as $lang)
                                @if ($lang->id === $post->lang_id)
                                <option value="{{$lang->id}}" selected>{{$lang->lng}}</option>
                                @else
                                <option value="{{$lang->id}}">{{$lang->lng}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- hidden inputs -->
                {{-- <input type="text" name="view" value="{{$post->view}}" hidden> --}}
                {{-- <input type="text" name="lang_id" value="{{$lang_id}}" hidden> --}}
                {{-- <input type="text" name="unique_id" value="{{$post->unique_id}}" hidden> --}}

                <div class="form-group row">
                    <label for="edit-post-date" class="col-sm-2 col-form-label col-form-label-lg text-left">Date</label>
                    <div class="col-sm-10">
                        <input type="date" name="date" id="edit-post-date" class="form-control" value="{{ date('Y-m-d', strtotime($post->date)) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="post-edit-status" class="col-sm-2 col-form-label col-form-label-lg text-left">Status</label>
                    <div class="col-sm-10">
                        <select name="status" id="post-edit-status" class="form-control">
                            <option value="published" @if($post->status === 'published') selected @endif>published</option>
                            <option value="unpublished" @if($post->status === 'unpublished') selected @endif>unpublished</option>
                            <option value="main" @if($post->status === 'main') selected @endif>main</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tags" class="col-sm-2 col-form-label col-form-label-lg text-left">Tags</label>
                    <div class="col-sm-10">
                        <input type="text" name="tags" value="{{$postTagsList}}" id="tags">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-lg">Update</button>
                </div>
            </form>

    </div>
</div>

@endsection

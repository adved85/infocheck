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
        /{{$post_id}}/translate</em>
</div>

<div class="create-post-section card">
    <h3 class="card-header">
        Translate Post N-{{$post_id}}/{{$next_unique_id}}/<code>{{app()->getLocale()}}</code>
    </h3>

    <div class="card-body">
        <form action="{{route('admin.document.uploadimage', app()->getLocale())}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="create-post-imgs-upload d-flex flex-row rounded border border-success py-2">

                <div class="btn-group">
                    <input type="file" name="images[]" id="images" multiple="multiple" class="btn btn-light">
                    <input type="text" hidden name="unique_id" value="{{$next_unique_id}}">
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

        <form action="{{route('admin.post.store', app()->getLocale())}}" method="POST" id="post_trans_form">
        @csrf

            <h4 class="bg-light text-left p-2 border rounded">Content/ <code>{{app()->getLocale()}}</code> </h4>

            <div class="form-group row">
                <label for="post-create-category" class="col-sm-2 col-form-label col-form-label-lg text-left">Category</label>
                <div class="col-sm-10">
                    <select name="category_id" id="post-create-category" class="form-control new-cat">
                        @foreach ($categories as $item)
                            @if ($item->item_id === $currentPost->getCategory()->first()->item_id)
                            <option value="{{$item->id}}" selected>{{$item->name}}</option>
                            @else
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="create-post-unique" class="col-sm-2 col-form-label col-form-label-lg text-left">Unique</label>
                <div class="col-sm-10">
                    <input type="text" name="unique_id" id="create-post-unique" class="form-control new-post" value="{{$next_unique_id}}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label for="create-post-titile" class="col-sm-2 col-form-label col-form-label-lg text-left">Title</label>
                <div class="col-sm-10">
                    <input type="text" name="title" id="create-post-titile" class="form-control new-post" placeholder="Post title" value="{{ old('title') }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="short_text" class="col-sm-2 col-form-label col-form-label-lg text-left">Short text</label>
                <div class="col-sm-10">
                    <textarea type="text" name="short_text" id="short_text" class="form-control new-post" rows="5">
                        {{ old('short_text') }}
                    </textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="html_code" class="col-sm-2 col-form-label col-form-label-lg text-left">HTML code</label>
                <div class="col-sm-10">
                    <textarea type="text" name="html_code" id="html_code" class="form-control new-post" rows="5">
                        {{ old('short_text') }}
                    </textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="create-post-image" class="col-sm-2 col-form-label col-form-label-lg text-left">Post image</label>
                <div class="col-sm-10">
                    <input type="text" name="img" id="create-post-image" class="form-control new-post" value="{{$currentPost->img}}">
                </div>
            </div>

            <div class="form-group row">
                <label for="create-post-meta-k" class="col-sm-2 col-form-label col-form-label-lg text-left">Meta-keys</label>
                <div class="col-sm-10">
                    <input type="text" name="meta_k" id="create-post-meta-k" class="form-control new-post" placeholder="this,post,about,...." value="{{ old('meta_k') }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="create-post-meta-d" class="col-sm-2 col-form-label col-form-label-lg text-left">Meta-description</label>
                <div class="col-sm-10">
                    <input type="text" name="meta_d" id="create-post-meta-d" class="form-control new-post" placeholder="this post about ...." value="{{ old('meta_d') }}">
                </div>
            </div>

            <!-- hidden inputs -->
            <input type="text" name="view" value="0" hidden>
            <input type="text" name="lang_id" value="{{$lang_id}}" hidden>
            <input type="text" name="unique_id" value="{{$next_unique_id}}" hidden>

            <div class="form-group row">
                <label for="create-post-date" class="col-sm-2 col-form-label col-form-label-lg text-left">Date</label>
                <div class="col-sm-10">
                    <input type="date" name="date" id="create-post-date" class="form-control new-post" value="{{$currentPost->date}}">
                </div>
            </div>

            <div class="form-group row">
                <label for="post-create-status" class="col-sm-2 col-form-label col-form-label-lg text-left">Status</label>
                <div class="col-sm-10">
                    <select name="status" id="post-create-status" class="form-control new-cat">
                        <option value="published" @if($currentPost->status === 'published') selected @endif>published</option>
                        <option value="unpublished" @if($currentPost->status === 'unpublished') selected @endif>unpublished</option>
                        <option value="main" @if($currentPost->status === 'main') selected @endif>main</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="create-post-date" class="col-sm-2 col-form-label col-form-label-lg text-left">Tags</label>
                <div class="col-sm-10">
                    <input type="text" name="tags" value="{{ old('tags') }}" id="tags" placeholder='Select or Add tags'>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-lg">Create</button>
            </div>
        </form>

    </div>
</div>

@endsection

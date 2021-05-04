@extends('admin.layouts.admin')

@section('title', 'Posts')


@section('lang_menu')
{{-- @include('admin.includes.menu', $langs) --}}
@endsection



@section('content')

<div class="text-left">
    <em>
        <a href="{{ route('admin.post.index', app()->getLocale())}}">Posts</a>
        /{{$post->id}}/Relations
    </em>
</div>

{{-- @include('admin.common.errors') --}}
<!-- here Errors and imgDebug -->
@include('admin.common.fileMessages')
@include('admin.common.oneerror')
@include('admin.common.success')




<div class="post-relations-section card">

    <h3 class="card-header text-secondary">Relations of Post № {{$post->id}}</h3>


    <div class="card-body">
        <form action="{{route('admin.document.uploadfile', app()->getLocale() )}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="post-relations-files-upload d-flex flex-row rounded border border-success py-2">

                <div class="btn-group">
                    <input type="file" name="files[]" id="files" multiple="multiple" class="btn btn-light">
                    <input type="text" hidden name="post_id" value="{{$post->id}}">
                    <input type="text" hidden name="unique_id" id="" value="{{$post->unique_id}}">
                    <input type="text" hidden name="folder_name" id="" value="{{$folder_name}}">
                </div>
                <div class="btn-group ml-3">
                    <button type="submit" class="btn btn-success">Upload Files</button>
                </div>
            </div>
        </form>
        <hr>


        {{-- @dump($docsObject) --}}


        @isset($docsObject)
        <form action="{{ route('admin.document.savedocstatus', app()->getLocale() )}}" method="POST">
            @csrf

            <div class="table-responsive-md">
                <h4>Attached Files</h4>
                <table class="table table-bordered table-sm">
                    <thead class="thead-dark">
                        <th>Id</th>
                        <th>Name</th>
                        <th>Link</th>
                        <th>Type</th>
                        <th>Is used</th>
                    </thead>
                    <tbody>
                        @forelse ($docsObject as $doc)
                        <tr>
                            <th scope="row">{{$doc->id}}</th>
                            <td>{{ $doc->name}}</td>
                            <td>{{ $doc->link}}</td>
                            <td>{{ $doc->type}}</td>
                            <td>
                                <input type="checkbox" name="cBox[{{$doc->id}}]" onchange="getStatusChangeValue(event)"
                                    @if ($doc->isused)
                                        checked
                                    @endif
                                >
                                <input type="text" id="cBox[{{$doc->id}}]" name="docs[{{$doc->id}}]" value="{{$doc->isused}}"  hidden>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="alert alert-info mt-3">
                                        No Attached documents.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    @if($post->getDocuments()->exists())
                    <tfoot>
                        <tr>
                            <td colspan="5">
                                <button type="submit" class="btn btn-outline-success px-5">Save</button>
                            </td>
                        </tr>
                    </tfoot>
                    @endif

                </table>
            </div>
        </form>
        @endisset


        @isset($comments)
        <hr class="mt-5">
        <div class="table-responsive-md">
                <h4>Comments</h4>
                <table class="table table-bordered table-sm">
                    <thead class="thead-dark">
                        <th>Id</th>
                        <th>Body</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action (show/hide)</th>
                    </thead>
                    <tbody class="mt-2">
                        @forelse ($comments as $comment)
                            <tr>
                            <form action="{{ route('admin.comment.savecommentstatus', app()->getLocale())}}" method="POST" id="f_{{$comment->id}}">
                                @csrf
                                <th scope="row">{{$comment->id}}</th>
                                <td>
                                    {{-- {{$comment->body}} --}}
                                    <textarea name="body" id="body" rows="3" form="f_{{$comment->id}}" style="width:100%" readonly>{{$comment->body}}</textarea>
                                </td>
                                @if ($comment->user()->exists())
                                <td class="align-middle">{{$comment['user']['name']}}</td>
                                <td class="align-middle">{{$comment['user']['email']}}</td>
                                @endif
                                <td class="align-middle">
                                    <input type="checkbox" name="cBox_{{$comment->id}}" onchange="getStatusChangeValue(event)" form="f_{{$comment->id}}"
                                    @if ($comment->approved)
                                    checked
                                    @endif
                                    >
                                    <input type="text" id="cBox_{{$comment->id}}" name="comment[{{$comment->id}}]" value="{{$comment->approved}}" form="f_{{$comment->id}}" hidden>
                                    <button type="submit" class="btn btn-outline-primary" form="f_{{$comment->id}}">Save Status</button>
                                </td>
                            </form>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                <div class="alert alert-info mt-3">
                                    No Comments.
                                </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
        </div>
        @endisset

        @isset($question)
        <hr class="mt-5">
        <div class="table-responsive-md">
            <h4>Replied Question by this Post</h4>
            <table class="table table-bordered table-sm">
                <thead class="thead-dark">
                    <th>Id</th>
                    <th>Body</th>
                    <th>Visible</th>
                    <th>Email</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @forelse ($question as $item)
                        <tr>
                            <th scope="row">{{$item->id}}</th>
                            <td>
                                <textarea name="body" id="q-body" rows="3" style="width:100%" readonly>{{$item->body}}</textarea>
                            </td>
                            <td>{{$item->visible? 'true' : 'false'}}</td>
                            <td>{{$item['user']['email']}}</td>
                            <td class="align-middle">
                                <form action="{{route('admin.question.reset',['locale' => app()->getLocale(), $item])}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger"
                                    onclick="return confirm('Do you really want to reset this Post from Question №-{{$item->id}}')?true:false">Reset From Question</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="alert alert-info mt-3">
                                    No relation with any Question.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @endisset


        @isset($picObject)
        {{-- @dump($picObject) --}}
            <hr class="mt-5">
            <form action="{{ route('admin.document.savepicstatus', app()->getLocale() )}}" method="POST">
                    @csrf

                    <div class="table-responsive-md">
                        <h4>Attached Pictures (LightBox)</h4>
                        <table class="table table-bordered table-sm">
                            <thead class="thead-dark">
                                <th>Id</th>
                                <th>Unique Id of Post</th>
                                <th>Link</th>
                                <th>Picture</th>
                                <th>Show in LightBox</th>
                            </thead>
                            <tbody>
                                @forelse ($picObject as $pic)
                                <tr>
                                    <th scope="row" style="vertical-align: middle">{{$pic->id}}</th>
                                    <td style="vertical-align: middle">{{$post->unique_id}}</td>
                                    <td style="vertical-align: middle">{{ $pic->pic_link}}</td>
                                    <td><img src="{{$pic->pic_link}}" alt="{{$pic->pic_link}}" width="120px"></td>
                                    <td style="vertical-align: middle">
                                        <input type="checkbox" name="pBox[{{$pic->id}}]" onchange="getStatusChangeValue(event)"
                                            @if ($pic->isused)
                                                checked
                                            @endif
                                        style="width:20px;height:20px">
                                        <input type="text" id="pBox[{{$pic->id}}]" name="pics[{{$pic->id}}]" value="{{$pic->isused}}"  hidden>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <div class="alert alert-info mt-3">
                                                No Attached pictures.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if($post->pictures()->exists())
                            <tfoot>
                                <tr>
                                    <td colspan="5">
                                        <button type="submit" class="btn btn-outline-success px-5">Save</button>
                                    </td>
                                </tr>
                            </tfoot>
                            @endif

                        </table>
                    </div>
                </form>
        @endisset

    </div><!-- card body -->

</div>
@endsection

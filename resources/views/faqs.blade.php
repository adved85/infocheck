@extends('layouts.faqs')
@section('faqs')
<div class="container clearfix margin-top-25">
        <div class="clearfix">
        <h3 id="comments-title">{{trans('text.faqs')}}</h3>

<ol class="commentlist clearfix">



@for ($i = 0; $i < count($data['question']); $i++)
    <li class="comment even thread-even depth-1" id="li-comment-1">
        <div id="comment-1" class="comment-wrap clearfix">
        <div class="comment-meta">
        <div class="comment-author vcard">
        <span class="comment-avatar clearfix">
        <img alt="" src="{{$data['question'][$i]['user']->avatar !== null ? $data['question'][$i]['user']->avatar: '/storage/profiles/default.png'}}" class="avatar avatar-60 photo avatar-default" height="60" width="60"></span>
        </div>
        </div>
        <div class="comment-content clearfix">
        <div class="comment-author"><span>{{$data['question'][$i]->created_at}}</span></div>
        <p>{{$data['question'][$i]->body}}</p>

        </div>
        <div class="clear"></div>
        </div>
        <ul class="children">
        <li class="comment byuser comment-author-_smcl_admin odd alt depth-2" id="li-comment-3">
        <div id="comment-3" class="comment-wrap clearfix">
        <div class="comment-meta">
        <div class="comment-author vcard">
        <span class="comment-avatar clearfix">
        <img alt="" src="/images/admin.png"   class="avatar avatar-40 photo" height="40" width="40"></span>
        </div>
        </div>
        {{-- @if (count($data['question'][$i]['question'])>0) --}}
        @if ($data['question'][$i]->question()->exists())
        <div class="comment-content clearfix">
                <div class="comment-author"><a href="#" rel="external nofollow" class="url">Icheck</a><span><a href="#" title="Permalink to this comment">{{$data['question'][$i]['question']->created_at}}</a></span></div>
                <p>
                    <i class="icon-reply1"></i>
                    {{$data['question'][$i]['question']->body}}
                </p>
        </div>
        @else
        <div class="comment-content clearfix">
                <div class="comment-author"><a href="#" rel="external nofollow" class="url">Icheck</a><span><a href="#" title="Permalink to this comment">{{$data['question'][$i]->created_at}}</a></span></div>
                <p><a href='{{config('app.url').'/'.$data['question'][$i]['lang']->lng.'/'.$data['question'][$i]->link}}'>
                    <i class="icon-line-link"></i>
                    {{$data['question'][$i]['post']->title.'/'.$data['question'][$i]['post']->date}}
                </a></p>

                </div>
        @endif

        <div class="clear"></div>
        </div>
        </li>
        </ul>
</li>
@endfor
</ol>
<div class="pagination-own">
    {{$data['question']->links()}}
             </div>
@if (Auth::check())
@if(Auth::user()->hasRole('i_user'))
 @if (Auth::user()->hasVerifiedEmail())

 <form id="add_comment" action="{{ route('leave.question',
 [  'locale'=> app()->getLocale()

 ] ) }}"  method="POST"   enctype="multipart/form-data">
           @csrf
   <input name='u_id' type='hidden' value='{{Auth::user()->id}}'/>
   <input type="text" name="folder_name" value="questions" hidden>
   <p> <textarea id ='textquest' name="textarea" class="required sm-form-control input-block-level short-textarea valid" required placeholder="{{trans('text.add_q')}}"></textarea></p>


   <div class="form-group">
   <label><span style="font-size: 11px">{{trans('text.zip')}}</span> </label>
        <input type="file" class="form-control-file"   name="files[]" multiple>

        </div>
   @if ($message = Session::get('warning_comment'))
   <div class="alert alert-success alert-block fade show">
       <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
   </div>
   @endif
   <button type='submit' class="btn btn-secondary">{{trans('text.ask')}}</button>
 </form>
  @else
  <p>{{trans('text.verified_question')}}</p>
  <a href="{{ route('verification.notice',
  [
      'locale'=> app()->getLocale(),
  ] ) }}" class="btn btn-secondary" target="_blank">{{trans('text.verify')}}</a>
 @endif
 @endif
  @else
 <p>{{trans('text.login_for_question')}}</p>
 <a href="{{ route('login', app()->getLocale()) }}" class="btn btn-secondary" target="_blank">{{trans('text.login')}}</a>
 <a href="{{ route('register', app()->getLocale()) }}" class="btn btn-secondary" target="_blank">{{trans('text.register')}}</a>

 @endif
<div class="clear"></div>



</div>

         </div>


@endsection

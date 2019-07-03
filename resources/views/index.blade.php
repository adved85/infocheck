@extends('layouts.index')
@section('posts_by_cat')

@for ($i = 0; $i <count($data['posts_by_menu']); $i++)
  <?php
       $k=$data['id'][$i];
      //echo $k;
      // die();
   ?>
   @if (count($data['posts_by_menu'][$i][$k])>0 )
    @switch($data['posts_by_menu'][$i]['layout'])
        @case('A')
        {{-- 3 hat verevy 1 hat  mec taky "class A" --}}
        <?php $limit=0; ?>
        <div  class="container clearfix mt-5 class-A">
                <div class="row">
                    <div class="owl-item  col-lg-12 class-A-cat-name"  style="display: contents" >
                        <span class="vert-line1"></span>
                        <span class="vert-line2"></span>
                        <span class="vert-line3"></span>
                        <h3 class="h3_omg" style="color: #0f1841">{{$data['posts_by_menu'][$i]['name']}}</h3>
                        <div class="line line_omg" ></div>
                    </div>
                    @foreach ($data['posts_by_menu'][$i][$k] as $item)
                        <?php $limit++;?>
                        @if ($limit<=3)
                        <div class="owl-item col-xs-12 col-sm-12 col-md-4 col-lg-4 bt-3 class-A-small">
                            <div class="hov nobottommargin">
                                <div class="feature-box media-box hov-hi-div-hid">
                                    <div class="entry mb-0 hov-hi-div" style="background: url('{{$item->img}}') center center; background-size: cover; height: 400px;">
                                        <a href="{{url(app()->getLocale().'/posts/'.$item->unique_id.'/'.urlencode($item->title))}}" class="own_link"></a>
                                    </div>
                                    <div class="text-overlay pl-4 pr-4 pb-2 hov-hi ">
                                        <div class="entry-c">
                                            <div class="entry-title">
                                                <h3 class="t600 mb-2" style="color:#fff">
                                                    {{-- <a href="{{url(app()->getLocale().'/posts/'.$item->unique_id.'/'.urlencode($item->title))}}" class="text-light">{!!str_limit($item->short_text , 30)!!}</a> --}}
                                                    <a href="{{url(app()->getLocale().'/posts/'.$item->unique_id.'/'.urlencode($item->title))}}" class="text-light">{!! $item->title !!}</a>
                                                </h3>
                                                <ul class="entry-meta_omg clearfix">
                                                    <li><i class="icon-calendar3"></i> {{ $item->date }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        @else
                        </div>
                        <div class="row clearfix" id="class-A-big">
                            <div class="owl-item col-lg-12">
                                    <div class="hov nobottommargin">
                                            <div class="feature-box  media-box hov-hi-div-hid">
                                <div class="entry  hov-hi-div" style="background: url('{{$item->img}}') center center; background-size: cover; height: 400px;">
                                        <a href="{{url(app()->getLocale().'/posts/'.$item->unique_id.'/'.urlencode($item->title))}}" class="own_link">
                                            </a>
                                </div>
                                <div class="text-overlay pl-4 pr-4 pb-2 hov-hi">
                                        <div class="entry-c">
                                                <div class="entry-title">
                                                <h3 class="t600 mb-2">
                                                    {{-- <a href="{{url(app()->getLocale().'/posts/'.$item->unique_id.'/'.urlencode($item->title))}}"  class="text-light">{!!str_limit($item->short_text , 80)!!}</a> --}}
                                                    <a href="{{url(app()->getLocale().'/posts/'.$item->unique_id.'/'.urlencode($item->title))}}"  class="text-light">{!! $item->title !!}</a>
                                                </h3>
                                                <ul class="entry-meta_omg clearfix">
                                                    <li><i class="icon-calendar3"></i> {{ $item->date }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        @endif
                    @endforeach
             </div>
            @break
        @case('B')
        {{-- 2 hat mec irar koxqi "class B" --}}
        <div  class="container clearfix mt-5 class-B">
            <?php $limit=0; ?>
                <div class="row">
                        <div class="owl-item  col-lg-12 class-B-cat-name" style="display: contents" >
                            <span class="vert-line1"></span>
                            <span class="vert-line2"></span>
                            <span class="vert-line3"></span>
                            <h3 class="h3_omg" style="color: #0f1841">{{$data['posts_by_menu'][$i]['name']}}</h3>
                            <div class="line line_omg" ></div>
                        </div>
                        @foreach ($data['posts_by_menu'][$i][$k] as $item)
                                <?php $limit++;?>
                                @if ($limit<=2)
                                <div class="owl-item  col-lg-6 mb-5 class-B-twins">
                                     <div class="hov nobottommargin">
                                        <div class="feature-box media-box hov-hi-div-hid">
                                        <div class="entry mb-0 hov-hi-div" style="background: url('{{$item->img}}') center center; background-size: cover; height: 400px;">
                                            <a href="{{url(app()->getLocale().'/posts/'.$item->unique_id.'/'.urlencode($item->title))}}" class="own_link">
                                        </a>
                                    </div>
                                    <div class="text-overlay pl-4  hov-hi pr-4 pb-2">
                                            <div class="entry-c">
                                                <div class="entry-title">
                                                    <h3 class="t600 mb-2">
                                                        {{-- <a  href="{{url(app()->getLocale().'/posts/'.$item->unique_id.'/'.urlencode($item->title))}}" class="text-light">{!!str_limit($item->short_text , 30)!!}</a> --}}
                                                        <a  href="{{url(app()->getLocale().'/posts/'.$item->unique_id.'/'.urlencode($item->title))}}" class="text-light">{!! $item->title !!}</a>
                                                    </h3>
                                                    <ul class="entry-meta_omg clearfix">
                                                        <li><i class="icon-calendar3"></i> {{ $item->date }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>

                                    </div>
                                @endif
                        @endforeach
                </div>
       </div>
            @break
            @case('C')
             {{-- 4 hat poqr irar koxqi "class C" --}}
                <div class="container clearfix mt-5 class-C">
                    <div class="row">
                    <div  class="owl-item  col-lg-12 class-C-cat-name" style="display: contents" >
                        <span class="vert-line1"></span>
                        <span class="vert-line2"></span>
                        <span class="vert-line3"></span>
                        <h3 class="h3_omg" style="color: #0f1841">{{$data['posts_by_menu'][$i]['name']}}</h3>
                        <div class="line line_omg" ></div>
                    </div>
                    @foreach ($data['posts_by_menu'][$i][$k] as $item)
                        {{-- <div class="col_one_fourth nobottommargin hov class-C-quarter"> --}}
                        <div class="col-lg-3 nobottommargin hov class-C-quarter">
                            <div class="feature-box media-box hov-hi mb-3">
                                <div class="fbox-media">
                                    <a href="{{url(app()->getLocale().'/posts/'.$item->unique_id.'/'.urlencode($item->title))}}" >
                                        <div class="hov-hi-div back" style="background-image:url('{{$item->img}}')" ></div>
                                        {{-- <img src="{{$item->img}}" alt="{{$data['posts_by_menu'][$i]['name']}}"> --}}
                                    </a>
                                </div>

                                <div class="fbox-desc">
                                    <a href="{{url(app()->getLocale().'/posts/'.$item->unique_id.'/'.urlencode($item->title))}}" >
                                        <h3>{{$item->title}}</h3>
                                    {{-- <p>{!!str_limit($item->short_text , 50)!!} </p> --}}
                                    </a>
                                    <ul class="entry-meta clearfix">
                                        <li><i class="icon-calendar3"> </i> {{ $item->date }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @break
            @case('D')
            {{-- 3 hat poqr irar koxqi "class D" --}}
            <?php $limit=0; ?>
                <div class="container clearfix mt-5 class-D" >
                    <div class="row">
                        <div  class="owl-item  col-lg-12 class-D-cat-name" style="display: contents" >
                            <span class="vert-line1"></span>
                            <span class="vert-line2"></span>
                            <span class="vert-line3"></span>
                            <h3 class="h3_omg" style="color: #0f1841">{{$data['posts_by_menu'][$i]['name']}}</h3>
                            <div class="line line_omg" ></div>
                        </div>
                        @foreach ($data['posts_by_menu'][$i][$k] as $item)
                        <?php $limit++; ?>
                            @if ($limit<=3)
                            {{-- <div class="col_one_third nobottommargin hov class-D-third"> --}}
                            <div class="col-lg-4 nobottommargin hov class-D-third">
                                <div class="feature-box media-box hov-hi mb-4">
                                    <div class="fbox-media">
                                    <a href="{{url(app()->getLocale().'/posts/'.$item->unique_id.'/'.urlencode($item->title))}}">
                                        <div class="hov-hi-div back" style="background-image:url('{{$item->img}}')" ></div>

                                        {{-- <img src="{{$item->img}}" alt="{{$data['posts_by_menu'][$i]['name']}}"> --}}
                                    </a>
                                        </div>
                                    <div class="fbox-desc">
                                        <a href="{{url(app()->getLocale().'/posts/'.$item->unique_id.'/'.urlencode($item->title))}}">
                                            <h3>{{$item->title}}</h3>
                                            {{-- <p>{!!str_limit($item->short_text , 50)!!} </p> --}}
                                        </a>
                                        <ul class="entry-meta clearfix">
                                            <li><i class="icon-calendar3"> </i> {{ $item->date }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>

            @break
        @default
    @endswitch
@endif
@endfor
@endsection

@section('main_poster')
@if ($data['big_post'] !== null)


 @if($data['layout'] === 'four')
 <!-- "Poster-type-one" - one big-left, three-small-right -->
 <?php $limit=0;
 ?>
 <div class="col-lg-7 hov nobottommargin main hov-hi-div-hid" id="poster-quarta-big">
    <a  href="{{url(app()->getLocale().'/posts/'.$data['big_post']['unique_id'].'/'.urlencode($data['big_post']['title']))}}">
        <div class="main_four hov-hi-div" style="background-image:url('{{$data['big_post']['img']}}')">
          </div>
    </a>
    <div class="text-overlay pl-4 pr-4 pb-2 hov-hi ">
        <div class="entry-c">
            <div class="entry-title">
                <h3 class="t600 mb-2">
                    {{-- <a href="{{url(app()->getLocale().'/posts/'.$data['big_post']['unique_id'].'/'.urlencode($data['big_post']['title']))}}" class="text-light">{!!str_limit($data['big_post']['title'] , 50)!!}</a></h3> --}}
                    <a href="{{url(app()->getLocale().'/posts/'.$data['big_post']['unique_id'].'/'.urlencode($data['big_post']['title']))}}" class="text-light">{!! $data['big_post']['title'] !!}</a></h3>
                <ul class="entry-meta_omg clearfix">
                    <li><i class="icon-calendar3"></i> {{$data['big_post']['date']}}</li>
                </ul>
            </div>
        </div>
    </div>
           {{-- <div class="feature-box media-box" style="position: absolute; bottom: 18px; left: 20px">
               <div class="fbox-desc hov-hi">
                    <h4 class="own-h4">
                  <a href="{{url(app()->getLocale().'/posts/'.$data['big_post']['unique_id'].'/'.urlencode($data['big_post']['title']))}}">
                   {{$data['big_post']['title']}}<br/>
                   {!!str_limit($data['big_post']['short_text'] , 50)!!}
                  </a>
                    </h4>
                    <ul class="entry-meta clearfix">
                        <li><i class="icon-calendar3"> </i> {{$data['big_post']['date']}}</li>
                    </ul>
                </div>
            </div> --}}

    </div>


    <div class="col-lg-5 mt-5-own pad">
        @for ($i = 0; $i < count($data['small_post']); $i++)
        <?php $limit++;?>
        @if ($limit<=3)
        <div class="ipost clearfix hov nobottommargin" style="{{$limit===1?'margin:0':'margin:10px 0 0 0' }}" id="poster-quarta-small-{{$i+1}}">
        <div class="col_half feature-box media-box hov-hi" style="margin-bottom: 0">
                    <div class="entry-image_omg fbox-media" style="overflow: hidden">
                            <a  href="{{url(app()->getLocale().'/posts/'.$data['small_post'][$i]->unique_id.'/'.urlencode($data['small_post'][$i]->title))}}">
                                    <div class="hov-hi-div back" style="background-image:url('{{$data['small_post'][$i]->img}}')" ></div>
                            {{-- <img  class="image_fade" src="{{$data['small_post'][$i]->img}}" alt="image" style="opacity: 1">
                             --}}
                            </a>
                    </div>
                </div>
                <div class="col_half  col_last hov-hi" style="margin-bottom: 0"> <!-- bottommargin-sm -->
                    <div class="entry-title">
                    <h3>
                        {{-- <a href="{{url(app()->getLocale().'/posts/'.$data['small_post'][$i]->unique_id.'/'.urlencode($data['small_post'][$i]->title))}}">{!!str_limit($data['small_post'][$i]->title, 50)!!}</a> --}}
                        <a href="{{url(app()->getLocale().'/posts/'.$data['small_post'][$i]->unique_id.'/'.urlencode($data['small_post'][$i]->title))}}">{!! $data['small_post'][$i]->title !!}</a>
                    </h3>
                    </div>
                    <ul class="entry-meta clearfix">
                        <li><i class="icon-calendar3"></i> {{$data['small_post'][$i]->date}}</li>
                    </ul>

                </div>
            </div>

            @endif
        @endfor



    </div>


 @else
 {{-- <div class="owl-item  col-lg-12" >
        <h3 class="h3_omg">Armenia 2</h3>
        <div class="line line_omg"></div>
    </div> --}}
<!-- "Poster-type-two" - one big-left, four-small-right -->
<div class="col-lg-6 nobottommargin hov pad" id="poster-quinta-big">
       <div class="feature-box media-box hov-hi ">
           <div class="fbox-media">
                <a href="{{url(app()->getLocale().'/posts/'.$data['big_post']['unique_id'].'/'.urlencode($data['big_post']['title']))}}">
                    <div class="hov-hi-div back" style="background-image:url('{{$data['big_post']['img']}}')" ></div>


                    {{-- <img  src="{{$data['big_post']['img']}}" alt="image" class="image_fade"></a> --}}
           </div>
           <div class="poster-main-text">
           <div class="text-overlay pl-4 pr-4 pb-2 hov-hi">
                <div class="entry-c">
                       <div class="entry-title">
                        <h3 class="t600 mb-2">
                            {{-- <a href="{{url(app()->getLocale().'/posts/'.$data['big_post']['unique_id'].'/'.urlencode($data['big_post']['title']))}}"class="text-light"> {!!str_limit($data['big_post']['title'] , 50)!!}</a> --}}
                            <a href="{{url(app()->getLocale().'/posts/'.$data['big_post']['unique_id'].'/'.urlencode($data['big_post']['title']))}}"class="text-light"> {!! $data['big_post']['title'] !!}</a>
                        </h3>
                        <ul class="entry-meta_omg clearfix">
                            <li><i class="icon-calendar3"></i> {{$data['big_post']['date']}}</li>
                        </ul>
                    </div>
               </div>
            </div>
        </div>
           {{-- <div class="fbox-desc fbox_omg">
                {{-- <h3>{{$data['big_post']['title']}}</h3>
                <h4 class="own-h4">
                <a    href="{{url(app()->getLocale().'/posts/'.$data['big_post']['unique_id'].'/'.urlencode($data['big_post']['title']))}}" class="text-light">
                            {!!str_limit($data['big_post']['short_text'] , 50)!!}
                </a>
                </h4>
               <ul class="entry-meta clearfix">
                                <li><i class="icon-calendar3"></i> {{$data['big_post']['date']}}</li>

               </ul>
           </div> --}}
       </div>
</div>

<div class="col-lg-6 nobottommargin col_last pad">
        <ul class="clients-grid grid-2 nobottommargin clearfix">
           @for ($i = 0; $i < count($data['small_post']); $i++)
        <li  class="nobottommargin hov mar{{$i+1}}" id="poster-quinta-small-{{$i+1}}">
                    <div class="feature-box media-box own">
                        <div class="fbox-media" >
                            <div class="text-overlay_omg hov-hi p">
                                <div class="entry-c">
                                    <div class="entry-title">
                                            <a href="{{url(app()->getLocale().'/posts/'.$data['small_post'][$i]->unique_id.'/'.urlencode($data['small_post'][$i]->title))}}" >
                                                {{-- <h5 class="t700 mb-2">{!!str_limit($data['small_post'][$i]->title, 50)!!}</h5> --}}
                                                <h5 class="t700 mb-2">{!! $data['small_post'][$i]->title !!}</h5>
                                            </a>
                                        <ul class="entry-meta_omg clearfix">
                                            <li><i class="icon-calendar3"></i> {{$data['small_post'][$i]->date}} </li>
                                        </ul>

                                    </div>


                                </div>
                            </div>
                            <a href="{{url(app()->getLocale().'/posts/'.$data['small_post'][$i]->unique_id.'/'.urlencode($data['small_post'][$i]->title))}}" >
                                <div class="hov-hi-div back" style="background-image:url('{{$data['small_post'][$i]->img}}')" ></div>

                       {{-- <img src="{{$data['small_post'][$i]->img}}" alt="image" > --}}
                            </a>
                    </div>
                    </div>
                </li>
            @endfor
        </ul>
</div>

 @endif
 @endif
 @endsection

@extends('layouts.category_posts')
@section('posts')

<div class="postcontent nobottommargin" id="current-category">
                    <div  class="owl-item  col-lg-12 category_own" style="display: contents" >
                        <div style= "display:flex;margin-bottom: 29px;">
                            <div style= "display:flex;width: 100%;">
                                <span class="vert-line1" style="margin: 0 2px 0"></span>
                                <span class="vert-line2"></span>
                                <span class="vert-line3"></span>
                                <h3 class="h3_omg" style="color: #0f1841">{{$data['posts_category']}}
                                </h3>
                                <div class="line line_omg" ></div>
                            </div>
                        </div>
                    </div>
    <div class="infinite-scroll" >
 @foreach ($data['post_test'] as $item)
    <div class="col_one_third hov nobottommargin height-317px  cat-post-item">
        <div class="feature-box media-box hov-hi mb-4">
            <div class="fbox-media">
         <a href="{{url(app()->getLocale().'/posts/'.$item->unique_id.'/'.urlencode($item->title))}}">
          <div class="hov-hi-div back" style="background-image:url('{{$item->img}}')" ></div>
                      {{-- <img src="{{$item->img}}" alt="image"  class="image_fade"> --}}
         </a>
                    </div>
            <div class="fbox-desc">
              <a   href="{{url(app()->getLocale().'/posts/'.$item->unique_id.'/'.urlencode($item->title))}}">
                <h3>{{$item->title}}</h3>
                <p>{!!str_limit($item->short_text , 50)!!} </p>
              </a>
                <ul class="entry-meta clearfix">
                    <li><i class="icon-calendar3"> </i> {{ trueFormat($item->date) }}</li>
                </ul>
            </div>
        </div>
    </div>
 @endforeach
 {{$data['post_test']->links()}}
</div>





</div>

{{-- <div class="pagination">
        <a href="#">&laquo;</a>
        <a href="#">1</a>
        <a href="#" class="active">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
        <a href="#">6</a>
        <a href="#">&raquo;</a>
      </div>
<div class="pagination">
        {{$data['posts']->links()}}
</div> --}}

@endsection

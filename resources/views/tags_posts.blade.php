@extends('layouts.tags_posts')
@section('tag_posts')

<div class="postcontent nobottommargin ">
<h3 class="h3_omg">{{trans('text.posts')}}</h3>
    <div class="line line_omg"></div>
    <div class="infinite-scroll fadeInUp animated"  data-animate="fadeInUp">
 @foreach ($data['post_test'] as $item)
    <div class="col_one_third bottommargin">
        <div class="feature-box media-box">
            <div class="fbox-media">
         <a href="{{url(app()->getLocale().'/posts/'.$item->unique_id.'/'.urlencode($item->title))}}">
                      <img id="{{$item->id}}" src="{{$item->img}}" alt="image"  class="image_fade">
         </a>
                    </div>
            <div class="fbox-desc">
              <a class="own-link-aa{{$item->id}}"  href="{{url(app()->getLocale().'/posts/'.$item->unique_id.'/'.urlencode($item->title))}}">
                <h3>{{$item->title}}</h3>
                <p>{!!str_limit($item->short_text , 80)!!} </p>
              </a>
                <ul class="entry-meta clearfix">
                    <li><i class="icon-calendar3"> </i> {{ $item->date }}</li>
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
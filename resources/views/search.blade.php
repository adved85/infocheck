@extends('layouts.search')
@section('search')

 <div class="postcontent nobottommargin ">
        <h3 class="h3_omg"> {{trans('text.search_result')}} &nbsp;&nbsp;&nbsp;" {{ $data['s']}} "</h3>
     <div class="nobottommargin mt-5">
        @foreach ($data['post'] as $post)
                <div class="mpost clearfix">
                        <div class="entry-image">
                            <a href="{{url($post->lng.'/posts/'.$post->unique_id.'/'.urlencode($post->title))}}">
                                    <img src="{{$post->img}}" alt="" data-no-retina=""></a>
                            </div>
                   <div class="entry-c">
                            <div class="entry-title">
                            <h4>
                                <a href="{{url($post->lng.'/posts/'.$post->unique_id.'/'.urlencode($post->title))}}"  class="text-extra-dark-gray margin-25px-bottom alt-font  font-weight-600 text-small search_link">{{$post->title}}</a>
                            </h4>
                            </div>
                        <ul class="entry-meta clearfix" style="margin-bottom: 0;">
                                <li><i class="icon-calendar3"></i> {{ trueFormat($post->date) }}</li>

                                </ul>
                         <div class="entry-content" style="margin-top: 0;">
                                       @php
                                       $show_symbols_size=600;
                                       $longt=strip_tags($post->html_code);
                                       $long_desc=preg_replace('/  +/', '', $longt);
                                       $pos = stripos(mb_strtolower($long_desc), mb_strtolower($data['s']));
                                       $pos > 50 && $pos < strlen($long_desc)  ? $skizb=$pos-50 : $skizb = 1;
                                   @endphp
                                   @if(stripos($post->html_code,$data['s']) !== false)
                                       @php
                                           if(strlen($long_desc)>$show_symbols_size){
                                               $show_text = substr($long_desc, $skizb, $show_symbols_size);
                                           }else{
                                               $show_text = $long_desc;
                                           }
                                           //$utf8string = "cakeæøå";
                                          // print_r($devide_text
                                           echo "<div class='show_text'>...".mb_substr($show_text, 1, -1, "UTF-8")."...</div>";
                                       @endphp

                                       @else
                                       @php
                                           $show_text = substr($long_desc, $skizb, $show_symbols_size);
                                           echo "<div class='show_text'>...".mb_substr($show_text, 1, -1, "UTF-8")."...</div>";
                                       @endphp
                                   @endif


                                    {{--If post content is > 200 in characters display 200 only or else display the whole content--}}
                                   {{-- strlen( $long_desc ) > 30 ? substr($long_desc, $skizb, 800) . ' ...'. strlen( $long_desc ) : $long_desc --}}


                            </div>



                       </div>

                    </div>

         @endforeach
        </div>
        @if( $data['post']->total() > 3 )
  <nav class="nobottommargin mt-5">
      <ul class="pagination" id="our-pagination">
          @if( $data['post']->firstItem() > 1 )
              <li class="page-item"><a class="page-link" href="{{$data['post']->previousPageUrl().'&s='.$data['s']  }}">{{trans('text.page_prev')}}</a></li>
          @endif

          @if( $data['post']->lastItem() < $data['post']->total() )
              <li class="page-item"><a class="page-link" href="{{$data['post']->nextPageUrl().'&s='.$data['s'] }}">{{trans('text.page_next')}}</a></li>
          @endif
      </ul>
  </nav>
@endif

</div>




@endsection

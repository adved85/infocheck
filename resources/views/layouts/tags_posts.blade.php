<html dir="ltr" lang="en-US">
    <head>
        <title>{{__('text.info_')}}</title>
        @include('../includes.links' )
      </head>
    <body class="stretched device-xl no-transition back_fixed">
            <div id="loading"><h1></h1></div>
            <div id="loaded" class="animate-bottom">
            {{-- @include('../includes.mini_menu_for_posts' ) --}}
            @include('../includes.main_menu' )
            @include('../includes.mini_menu' )


 <section id="content" style="margin-bottom: 0px;">
    <div class="content-wrap">
        <div class="container clearfix">
                @if ($data['not_found'] === 'found')
          @yield('tag_posts')
          @else

          <div class="postcontent nobottommargin ">
                <div  class="owl-item  col-lg-12 category_own" style="display: contents" >
                        <div style= "display:flex;margin-bottom: 29px;">
                            <div style= "display:flex;width: 100%;">
                                <span class="vert-line1" style="margin: 0 2px 0"></span>
                                <span class="vert-line2"></span>
                                <span class="vert-line3"></span>
                                <h3 class="h3_omg" style="color: #0f1841">{{$data['tag_name']}}
                                </h3>
                                <div class="line line_omg" ></div>
                            </div>
                        </div>
                    </div>

               <span>{{$data['not_found']}}</span>
          </div>
                   @endif
          <div class="sidebar nobottommargin col_last widget_links">
                <div id="post-lists" class="widget clearfix">
              @include('../includes.most_viewed')
                </div>
                {{-- <div class="widget clearfix col_last">
                    @include('../includes.all_tags')
            </div> --}}
          </div>
        </div>
  </div>
  @include('../includes.right_side')
</section>


     {{-- @include('../includes.footer') --}}
            </div>
    <div id="gotoTop" class="icon-angle-up"></div>
  @include('../includes.scripts')
    </body>
    </html>

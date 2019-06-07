<html dir="ltr" lang="en-US">
    <head>
        <title>InfoCheck</title>
        @include('../includes.links' )
      </head>
    <body class="stretched device-xl no-transition back_fixed">
            @include('../includes.mini_menu_for_posts' )
            @include('../includes.main_menu' )


 <section id="content" style="margin-bottom: 0px;">
    <div class="content-wrap">
        <div class="container clearfix">
                @if ($data['not_found'] === 'found')
          @yield('tag_posts')
          @else

          <div class="postcontent nobottommargin ">
               <h3 class="h3_omg">{{trans('text.posts')}}</h3>
               <div class="line line_omg"></div>
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

    <div id="gotoTop" class="icon-angle-up"></div>
  @include('../includes.scripts')
    </body>
    </html>

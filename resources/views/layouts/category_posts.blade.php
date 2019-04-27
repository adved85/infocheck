<html dir="ltr" lang="en-US">
    <head>
        <title>InfoCheck</title>
        @include('../includes.links' )
      </head>
    <body class="stretched device-xl no-transition">
            @include('../includes.mini_menu' )
            @include('../includes.main_menu' )


 <section id="content" style="margin-bottom: 0px;">
    <div class="content-wrap">
        <div class="container clearfix">
          @yield('posts')
          <div class="sidebar nobottommargin col_last widget_links">
                <div id="post-lists" class="widget clearfix">
              @include('../includes.most_viewed')
                </div>
          </div>
        </div>
  </div>
</section>


     {{-- @include('../includes.footer') --}}

    <div id="gotoTop" class="icon-angle-up"></div>
  @include('../includes.scripts')
    </body>
    </html>

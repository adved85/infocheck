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
                        @yield('search')
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
            <script>
                    var searchInput = '{{$data["s"]}}';
                    function displayMatches() {
                        var regex = new RegExp(searchInput, 'gi')
                        $(".search_link, .show_text").each(function(){
                            var a1=$(this).text();
                    var response = a1.replace(regex, function(str) {
                            return "<span style='background-color: yellow;'>" + str + "</span>"
                        })
                        $(this).html(response)
                                })
                                }
                                setTimeout(displayMatches, 300);
            </script>
    </body>
    </html>

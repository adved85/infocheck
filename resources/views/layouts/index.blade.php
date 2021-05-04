<html dir="ltr" lang="en-US">
    <head>
        <title>{{__('text.info_')}}</title>
        @include('../includes.links' )
      </head>
    <body class="stretched device-xl back_fixed no-transition">
        <div id="loading"><h1></h1></div>
        <div id="loaded" class="animate-bottom">
            @include('../includes.main_menu' )
            @include('../includes.mini_menu' )
            @include('../includes.subscribe_response')


            <section id="content" style="margin-bottom: 0px;" >
                    <div class="content-wrap">
                        <div class="container clearfix own">
                            <div class="row container clearfix own" id="main_poster">
                                @if  ($data['no_post'])
                                @yield('main_poster')
                                @else
                                   {{ trans('text.no_post') }}
                                @endif
                                </div>
                        </div>
                            @yield('posts_by_cat')
                    </div>
                    @include('../includes.question_icon')
                    @include('../includes.right_side')
            </section>
            @include('../includes.footer')
        </div>
    <div id="gotoTop" class="icon-angle-up"></div>
    @include('../includes.scripts')

    </body>
    </html>

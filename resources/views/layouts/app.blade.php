<html dir="ltr" lang="en-US">
    <head>
        <title>{{__('text.info_')}}</title>
        @include('../includes.links' )
      </head>
    <body class="stretched device-xl no-transition back_fixed">

            <div id="loading"><h1></h1></div>
            <div id="loaded" class="animate-bottom">

            @include('../includes.main_menu' )
            @include('../includes.mini_menu' )
            @include('../includes.subscribe_response')
            <section id="content" style="margin-bottom: 0px;">


                    <div class="content-wrap1">
                            {{-- <div id="logo" style='margin:0 40px'>
                                <a href="{{url(app()->getLocale().'/')}}" class="standard-logo" data-dark-logo="/images/logo-dark.png"><img src="/images/logo.png" alt=" Logo"></a>
                                <a href="{{url(app()->getLocale().'/')}}" class="retina-logo" data-dark-logo="/images/logo-dark@2x.png"><img src="/images/logo@2x.png" alt="Logo"></a>
                            </div> --}}
                        <div class="container clearfix">
                            @yield('content')
                        </div>
                    </div>
                    @include('../includes.right_side')
            </section>

        {{-- <main class="py-4">

        </main> --}}
        @include('../includes.footer')
            </div>
        @include('../includes.scripts')

</body>
</html>

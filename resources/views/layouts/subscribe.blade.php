<html dir="ltr" lang="en-US">
    {{-- this layout for both - auth and subscribe email verification --}}
    <head>
        <title>{{__('text.info_')}}</title>
        @include('../includes.links' )


        <style>
        #top-bar {
            top: 20px;
        }
        #right-side {
            top: 93px;
        }
        </style>
      </head>
    <body class="stretched device-xl no-transition back_fixed">

        {{-- <div id="loading"><h1></h1></div>
        <div id="loaded" class="animate-bottom"></div> --}}
            @include('../includes.mini_menu' )
            @include('../includes.subscribe_response')
            {{-- @include('../includes.main_menu' ) --}}


        <div id="wrapper" class="clearfix back_fixed" style="opacity: 1; animation-duration: 1500ms;">

            <section id="content" style="margin-bottom: 0px;">
                <div class="content-wrap1">
                {{-- <div id="logo" style='margin:0 40px'>
                    <a href="{{url(app()->getLocale().'/')}}" class="standard-logo" data-dark-logo="/images/logo-dark.png"><img src="/images/logo.png" alt=" Logo"></a>
                    <a href="{{url(app()->getLocale().'/')}}" class="retina-logo" data-dark-logo="/images/logo-dark@2x.png"><img src="/images/logo@2x.png" alt="Logo"></a>
                </div> --}}
                <div class="container clearfix">
                    <main class="py-4">
                            @yield('content')
                    </main>
                </div>
                </div>
                @include('../includes.right_side')
            </section>

            @include('../includes.footer')
        </div>


        <script src="/js/jquery.js"></script>
        <script src="/js/plugins.js"></script>

{{-- <script>

    window.onload = function() {
        loading.style.display = 'none'
        // loaded.style.visibility = 'visible'
        // loaded.style.display = 'block'
        // header.style.display = 'block'
        // footer.style.display = 'block'
        // content.style.display = 'block'
    }

</script> --}}
</body>
</html>

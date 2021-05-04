<html dir="ltr" lang="en-US">
    <head>
        <title>InfoCheck</title>
        @include('../includes.links' )
      </head>
    <body class="stretched device-xl no-transition">
            {{-- @include('../includes.mini_menu_for_posts') --}}
            {{-- @include('../includes.main_menu' ) --}}

     <section id="content" style="margin-bottom: 0px;">
            <div class="content-wrap">
                    <div class="container clearfix">
                        <div class="container-fluid vertical-middle1 center clearfix" >
                                <center>
                                        <div id="logo" style="float:none; margin:0">
                                                <a href="{{url('/')}}" class="standard-logo" data-dark-logo="/images/logo-dark.png"><img src="/images/logo.png" alt=" Logo"></a>
                                                <a href="{{url('/')}}" class="retina-logo" data-dark-logo="/images/logo-dark@2x.png"><img src="/images/logo@2x.png" alt="Logo"></a>
                                            </div>
                                        </center>
                                    <div class="error404">404!</div>
                                <div class="heading-block nobottomborder">
                                <h4>{{trans('text.error_page')}}</h4>
                                <span>{{trans('text.error_page_text')}}</span>
                                </div>

                        </div>
                    </div>
                </div>
    </section>

</div>

<script src="/js/jquery.js"></script>
<script src="/js/plugins.js"></script>
<script src="/js/functions.js"></script>
<script src="/js/greedyNav.js"></script>
<script src="/js/jquery.jscroll.min.js"></script>
<script src='/js/lib/moment.min.js'></script>
<script src='/js/fullcalendar.min.js'></script>
<script src='/js/locale-all.js'></script>
<script src="/js/calen.js"></script>




</body>
</html>

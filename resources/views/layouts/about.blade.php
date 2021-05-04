
<style>
#about_us {
    padding: 15px;
}

#about_us img {
        margin-top: 20px;
        margin-bottom: 20px;
}

@media (max-width: 575.98px) {
    #about_us .container.clearfix {
        width: 100% !important;
        padding-left: 15px !important;
        padding-right: 15px !important;
    }
}

</style>

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
            @include('../includes.subscribe_response');

            <section id="content" style="margin-bottom: 0px;">

                <div id="about_us">
                    <div class="content-wrap">
                        <div class="container clearfix">
                            <div class="row">

                                        @yield('about')

                            </div>
                        </div>
                    </div>
                    @include('../includes.right_side')
                </div>
            </section>
            @include('../includes.footer')
        </div>
    <div id="gotoTop" class="icon-angle-up"></div>
  @include('../includes.scripts')

    </body>
    </html>

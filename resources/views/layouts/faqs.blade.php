<html dir="ltr" lang="en-US">
    <head>
        <title>{{__('text.info_')}}</title>
        @include('../includes.links' )
      </head>
    <body class="stretched device-xl no-transition back_fix_rotate">

            <div id="loading"><h1></h1></div>
            <div id="loaded" class="animate-bottom">

            @include('../includes.main_menu' )
            @include('../includes.mini_menu' )
            @include('../includes.subscribe_response');

     <section id="content" style="margin-bottom: 0px;">


              <div class="content-wrap">
                    <div class="container clearfix">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url(app()->getLocale().'/')}}">{{trans('text.home')}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route('faqs', app()->getLOcale()) }}">{{trans('text.faqs')}}</a></li>

                            </ol>
                          </div>
                          @yield('faqs')

                          @isset(session()->get( 'flDebug' )['errors'])
                          <div class="modal-on-load" data-target="#myModal1"></div>
                            <div class="modal1 mfp-hide" id="myModal1">
                                    <div class="block divcenter" style="background-color: #FFF; max-width: 400px;">
                                <div class="center" style="padding: 30px 0 0;">
                                        <h3 style="margin: 0 0 15px;"> {{trans('text.send_quest_error')}}</h3>
                                        <div style="font-size: 20px;">  {{trans('text.thanks')}} </div>
                                </div>
                                    <div class="section center nomargin" style="padding: 20px;">
                                    <a href="#" class=" btn btn-secondary" onClick="$.magnificPopup.close();return false;">{{trans('text.close')}}</a>
                                    </div>
                                    </div>
                              </div>
                           @endisset
                                @isset(session()->get( 'flDebug' )['success'])
                                <div class="modal-on-load" data-target="#myModal1"></div>
                            <div class="modal1 mfp-hide" id="myModal1">
                                    <div class="block divcenter" style="background-color: #FFF; max-width: 400px;">
                                    <div class="center" style="padding: 30px 0 0;">
                                    <h3 style="margin: 0 0 15px;"> {{trans('text.send_quest_ok')}}</h3>
                                    <div style="font-size: 20px;">  {{trans('text.thanks')}} </div>
                                    </div>
                                    <div class="section center nomargin" style="padding: 20px;">
                                    <a href="#" class=" btn btn-secondary" onClick="$.magnificPopup.close();return false;">{{trans('text.close')}}</a>
                                    </div>
                                    </div>
                              </div>

                        @endisset

              </div>
              @include('../includes.right_side')
     </section>
     @include('../includes.footer')
    </div>
    <div id="gotoTop" class="icon-angle-up"></div>
  @include('../includes.scripts')
  <script>
        $('#textquest').val('');
   </script>
    </body>
    </html>

<footer id="footer" class="dark"  >
        <div class="container">

            <div class="footer-widgets-wrap clearfix">
                <div class="col_one_third">

                        <div class="widget clearfix">
                            <div class="copyrights-menu copyright-links clearfix">
                                <a href="{{url(app()->getLocale().'/')}}">{{trans('text.home')}} </a>/ <a href="{{url(app()->getLocale().'/about')}}">{{trans('text.about_us')}} </a>

                            </div>

                            <div style="background: url('/images/world-map.png') no-repeat center center; background-size:contain">
                                <address>

                                   <a href="http://bit.ly/orbeli23" target="_blank"> {{trans('text.address2')}} </a><br>
                                </address>
                                <abbr title="{{trans('text.second_icon_text')}}"><strong>{{trans('text.second_icon_text')}}:</strong></abbr> <a href="tel:+37460488714">+374 60 48 87 14</a><br>
                                <abbr title="{{trans('text.email')}}"><strong> {{trans('text.email')}}:</strong></abbr> <a href="mailto:info@infocheck.am"> info@infocheck.am </a>
                            </div>
                        </div>


                </div>
                <div class="col_two_third col_last">
                    <div class="widget subscribe-widget clearfix customjs">
                        <h5>{{trans('text.info_')}}</h5>
                        <div class="widget-subscribe-form-result">
                                @if ($message = Session::get('errorSubs'))
                                <h5 style="color:red">{{$message}}</h5>
                                @endif
                        </div>
                        <form id="widget-subscribe-form" action="{{route('subscribe.saveEmail', app()->getLocale())}}" role="form" method="post" class="nobottommargin" novalidate="novalidate">
                            @csrf
                            <div class="input-group divcenter">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="icon-email2"></i></div>
                                </div>
                                <input type="email" id="widget-subscribe-form-email" name="email" data-name="widget-subscribe-form-email" class="form-control required email" placeholder="{{trans('text.third_icon_text')}}">
                                <div class="input-group-append">
                                <button class="btn btn-success" type="submit">{{trans('text.subscribe')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div id="copyrights">
            <div class="container clearfix">
                <div class="col_half">
                        InfoCheck © <?php echo date("Y"); ?> {{trans('text.footer_reserved')}}.<br>
                    <div class="copyright-links"> {{trans('text.footer_second')}} <a href="https://web-ex.tech/" target="_blank">{{trans('text.footer_webex')}}  </a> </div>
                </div>
                <div class="col_half col_last tright">
                    <div class="fright clearfix">
                        <a href="https://www.facebook.com/infocheck.am/" class="social-icon si-small si-borderless si-facebook">
                            <i class="icon-facebook"></i>
                            <i class="icon-facebook"></i>
                        </a>
                        <a href="#" class="social-icon si-small si-borderless si-twitter">
                            <i class="icon-twitter"></i>
                            <i class="icon-twitter"></i>
                        </a>
                        <a href="#" class="social-icon si-small si-borderless si-linkedin">
                            <i class="icon-linkedin"></i>
                            <i class="icon-linkedin"></i>
                        </a>
                        <a href="#" class="social-icon si-small si-borderless si-vk">
                            <i class="icon-vk"></i>
                            <i class="icon-vk"></i>
                        </a>

                        <a href="#" class="social-icon si-small si-borderless si-odnoklassniki">
                            <i class="icon-odnoklassniki"></i>
                            <i class="icon-odnoklassniki"></i>
                        </a>
                        <a href="#" class="social-icon si-small si-borderless si-instagram">
                            <i class="icon-instagram"></i>
                            <i class="icon-instagram"></i>
                        </a>

                    </div>
                    <div class="clear"></div>
                    <i class="icon-envelope"></i> <a class="ff" href="mailto:info@infocheck.am"> info@infocheck.am </a> <span class="middot">·</span> <i class="icon-phone"></i> <a class="ff" href="tel:+37460488714">+374 60 48 87 14</a> <span class="middot"></span>
                </div>
            </div>
        </div>
</footer>

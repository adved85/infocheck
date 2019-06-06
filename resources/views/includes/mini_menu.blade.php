<div id="wrapper" class="clearfix" style="opacity: 1; animation-duration: 1500ms;">

        <div id="top-bar">
         <div class="container clearfix own">
          <div class="col_half nobottommargin">
           <div class="top-links">
            <ul class="sf-js-enabled clearfix" style="touch-action: pan-y;">
             <li><a href="{{url(app()->getLocale().'/')}}">{{trans('text.home')}}</a></li>
             <li><a href="{{route('faqs', app()->getLocale()) }}">{{trans('text.faqs')}}</a></li>
             @auth
             <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout', app()->getLocale()) }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('login.Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>


         @else

             <li><a href="{{ route('register', app()->getLocale()) }}">{{ __('register.Register') }}</a></li>
             <li><a href="{{ route('login', app()->getLocale()) }}" class="sf-with-ul">{{ __('login.Login') }}</a>
                @endauth
             </li>
            <!-- Subscriber's Email activation result session-message -->
            @if(session()->get('subscribeResponse') !== null)
            <style>
                @media (min-width: 768px) and (max-width: 991.98px) {

                    .info_ {
                        top: 168px;
                        color: #2d2f2f;
                        z-index: 1;
                    }
                    #logo img {
                        box-shadow: none;
                        height: 70px;
                    }

                }

            </style>
            @endif


             @isset(session()->get('subscribeResponse')['success'])
                <li class="nav-item subs-response">
                    <div class="alert alert-success alert-dismissible fade show" style="padding:0 1rem 0 2rem">
                        <button type="button" class="close" data-dismiss="alert" style="position: relative;">&times;</button>
                        {{ session()->get('subscribeResponse')['success'] }}
                    </div>
                </li>
             @endisset
             @isset(session()->get('subscribeResponse')['warning'])
                <li class="nav-item subs-response">
                    <div class="alert alert-warning alert-dismissible fade show" style="padding:0 1rem 0 2rem">
                        <button type="button" class="close" data-dismiss="alert" style="position: relative;">&times;</button>
                        {{ session()->get('subscribeResponse')['warning'] }}
                    </div>
                </li>
             @endisset

             @isset(session()->get('subscribeResponse')['error'])
                <li class="nav-item subs-response">
                    <div class="alert alert-danger alert-dismissible fade show" style="padding:0 1rem 0 2rem">
                        <button type="button" class="close" data-dismiss="alert" style="position: relative;">&times;</button>
                        {{ session()->get('subscribeResponse')['error'] }}
                    </div>
                </li>
             @endisset
            <!-- Subs msg-end -->
            </ul>
           </div>


            </div>
                <div>
                 <ol class="breadcrumb breadcrumb_omg"  style=" font-weight: bolder">
                    <?php
                         $lngg=config('app.locales');
                         $trans = config('app.locale_trans');

                    ?>

                    @foreach (config('app.locales') as $item => $name)
                    <li class="breadcrumb-item1" title="{{$lngg[$item]}}">
                        <a href="{{route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$item]) }}"
                        @if (app()->getLocale() == $item) style="display:none" @endif > &nbsp;
                        {{ $trans[$item] }}

                            @if (app()->getLocale() !== 'ru')
                                @if (!$loop->last) <span class="lang-divider"> |</span> @endif
                            @else
                                @if ($loop->first)  <span class="lang-divider"> |</span> @endif
                            @endif
                        </a>
                    </li>
                    @endforeach
                 </ol>
                </div>
        </div>
        </div>

</div>


<div id="wrapper" class="clearfix" style="opacity: 1; animation-duration: 1500ms;">

        <div id="top-bar">
         <div class="container clearfix own">
          <div class="col_half nobottommargin">
           <div class="top-links">
            <ul class="sf-js-enabled clearfix" style="touch-action: pan-y;">
             <li><a href="{{url(app()->getLocale().'/')}}">{{trans('text.home')}}</a></li>
             <li><a href="{{route('faqs', app()->getLOcale()) }}">{{trans('text.faqs')}}</a></li>
             @auth
             <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout', app()->getLOcale()) }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('login.Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout', app()->getLOcale()) }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>


         @else

             <li><a href="{{ route('register', app()->getLocale()) }}">{{ __('register.Register') }}</a></li>
             <li><a href="{{ route('login', app()->getLocale()) }}" class="sf-with-ul">{{ __('login.Login') }}</a>
                @endauth
             </li>
            </ul>
           </div>
          </div>
                  <div>
                 <ol class="breadcrumb breadcrumb_omg" style=" font-weight: bolder">
                    <?php
                        $lngg=config('app.locales');
                        $trans = config('app.locale_trans');
                    ?>
                    @foreach (config('app.locales') as $item => $name)
                    <li class="breadcrumb-item1" title="{{$lngg[$item]}}">
             @switch($data['call'])
                 @case('archieve')
                 <a href="{{route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$item,'date' => $data['date']]) }}"
                        @if (app()->getLocale() == $item) style="display:none" @endif  >  &nbsp;
                        {{ $trans[$item] }}

                            @if (app()->getLocale() !== 'ru')
                                @if (!$loop->last)  <span class="lang-divider"> |</span> @endif
                            @else
                                @if ($loop->first)  <span class="lang-divider"> |</span> @endif
                            @endif
                       </a>
                     @break
                 @case('single')
                 <a href="{{route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$item,'unique_id' => $data['unique_id'],'title' => $data['title'] ]) }}"
                        @if (app()->getLocale() == $item) style="display:none" @endif > &nbsp;
                        {{ $trans[$item] }}

                            @if (app()->getLocale() !== 'ru')
                                @if (!$loop->last)  <span class="lang-divider"> |</span> @endif
                            @else
                                @if ($loop->first)  <span class="lang-divider"> |</span> @endif
                            @endif
                       </a>
                     @break
                @case('tags')
                <a href="{{url('/')}}"
                    @if (app()->getLocale() == $item) style="display:none" @endif > &nbsp;
                    {{ $trans[$item] }}

                            @if (app()->getLocale() !== 'ru')
                                @if (!$loop->last)  <span class="lang-divider"> |</span> @endif
                            @else
                                @if ($loop->first)  <span class="lang-divider"> |</span> @endif
                            @endif
                    </a>
                    @break
                @case('search')
                <a href="{{url('/')}}"
                    @if (app()->getLocale() == $item) style="display:none" @endif > &nbsp;
                    {{ $trans[$item] }}

                            @if (app()->getLocale() !== 'ru')
                                @if (!$loop->last)  <span class="lang-divider"> |</span> @endif
                            @else
                                @if ($loop->first)  <span class="lang-divider"> |</span> @endif
                            @endif
                    </a>
                    @break
                    @case('404')
                    <a href="{{url('/')}}"
                        @if (app()->getLocale() == $item) style="display:none" @endif > &nbsp;
                        {{ $trans[$item] }}

                            @if (app()->getLocale() !== 'ru')
                                @if (!$loop->last)  <span class="lang-divider"> |</span> @endif
                            @else
                                @if ($loop->first)  <span class="lang-divider"> |</span> @endif
                            @endif
                        </a>
                        @break

                 @default
                 <a href="{{route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$item,'category_item_id' => $data['item_id'] ]) }}"
                        @if (app()->getLocale() == $item) style="display:none" @endif > &nbsp;
                        {{ $trans[$item] }}

                            @if (app()->getLocale() !== 'ru')
                                @if (!$loop->last)  <span class="lang-divider"> |</span> @endif
                            @else
                                @if ($loop->first)  <span class="lang-divider"> |</span> @endif
                            @endif
                       </a>
             @endswitch

                    </li>
                    @endforeach
                 </ol>
             </div>
         </div>
        </div>

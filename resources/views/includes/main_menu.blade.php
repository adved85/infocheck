

        <ol class="large-lang-menu" style=" font-weight: bolder;display:none">

        @foreach ($data['lng'] as $key => $item)
            <li class="breadcrumb-item1" title="{{$item['lng_name']}}">
            @if (Route::current()->getName() !== 'register' && Route::current()->getName() !== 'login' &&
                Route::current()->getName() !== 'faqs' && Route::current()->getName() !== 'index_page' &&
                Route::current()->getName() !== 'about_us')
                @switch($data['call'])
                @case('archieve')
                    @if (app()->getLocale() !== $item['lng'])
                    <a href="{{route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$item['lng'],'date' => $data['date']]) }}">
                        &nbsp;{{ $item['lng_root'] }}
                        <span class="lang-divider"> |</span>
                    </a>
                    @endif
                    @break
                @case('single')
                    @if (app()->getLocale() !== $item['lng'])
                    <a href="{{route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$item['lng'],'unique_id' => $data['unique_id'],'title' => $data['title'] ]) }}">
                        &nbsp;{{ $item['lng_root']}}
                        <span class="lang-divider"> |</span>
                    </a>
                    @endif
                    @break
                @case('tags')
                    @if (app()->getLocale() !== $item['lng'])
                    <a href="{{url('/')}}">
                        &nbsp;{{ $item['lng_root'] }}
                        <span class="lang-divider"> |</span>
                    </a>
                    @endif
                    @break
                @case('search')
                    @if (app()->getLocale() !== $item['lng'])
                    <a href="{{url('/')}}">
                        &nbsp;{{ $item['lng_root'] }}
                        <span class="lang-divider"> |</span>
                    </a>
                    @endif
                    @break
                @case('404')
                    @if (app()->getLocale() !== $item['lng'])
                    <a href="{{url('/')}}">
                        &nbsp;{{ $item['lng_root'] }}
                        <span class="lang-divider"> |</span>
                    </a>
                    @endif
                    @break

                @default
                @if (app()->getLocale() !== $item['lng'])
                    <a href="{{route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$item['lng'],'category_item_id' => $data['item_id'] ]) }}">
                        &nbsp;{{ $item['lng_root'] }}
                        <span class="lang-divider"> | </span>
                    </a>
                @endif
                @endswitch

            @else
                @if (app()->getLocale() !== $item['lng'])
                <a href="{{route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$item['lng']]) }}">
                    &nbsp;{{ $item['lng_root'] }}
                    <span class="lang-divider"> | </span>
                </a>
                @endif
            @endif

        </li>
        @endforeach
        </ol>


     <header id="header" class="full-header">

            <div id="header-wrap" class="">
            <div class="container clearfix">
                      <div id="logo" title="Icheck">
                        <a href="{{url(app()->getLocale().'/')}}" class="standard-logo" data-dark-logo="/images/logo-dark.png"><img src="/images/logo.png" alt=" Logo"></a>
                        <a href="{{url(app()->getLocale().'/')}}" class="retina-logo" data-dark-logo="/images/logo-dark@2x.png"><img src="/images/logo@2x.png" alt="Logo"></a>

                    <button class="own burger2"><i class="icon-reorder"></i></button>
                    </div>
                    <a href="{{url(app()->getLocale().'/')}}" >
                        <h1 class="info_">{{trans('text.info_')}}</h1>
                    </a>

                <nav class='greedy'>
                    <ul class='links sf-js-enabled'>
                        <!-- hb-fill-middle2-bg -->
                      @foreach ($data['menu'] as $item)
                          <li class="hbtn hb-fill-right "><a href="{{url(app()->getLocale().'/post/'.urlencode($item->item_id))}}"
                             class="sf-with-ul ">{{$item->name}}</a></li>
                      @endforeach
                    <li  class="hbtn hb-fill-right"><a href="{{url(app()->getLocale().'/about')}}"
                            class="sf-with-ul">{{trans('text.about_us')}}</a></li>
                    </ul>
                    <button class="own"><i class="icon-reorder"></i></button>

                    <ul class='hidden-links hidden'></ul>

                    <div id="top-cart">
                    <a href="#" id="top-cart-trigger"><i class="icon-calendar21"></i></a>
                    <div class="top-cart-content">

                    <div class="top-cart-items">
                            <div id="arch" style="z-index:1000">
                                    <a class="lang" href="javascript:void(0);"><i class="fa fa-calendar" aria-hidden="true" style="font-size: 23px;"></i></a>

                                    <div class="calendar" style=" display:block;">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                {!! $data['event']->calendar() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    </div>
                    </div>
                    <div id="top-search">
                    <a href="#" id="top-search-trigger"><i class="icon-search3"></i><i class="icon-line-cross"></i></a>
                    <form action="{{ route('search',
                    [  'locale'=> app()->getLocale()
                    ] ) }}"  method="GET">

                    <input type="text"  class="form-control" name="s" value="{{ Request::query('s') }}" placeholder="{{trans('text.search')}}" autocomplete="off">
                    <i class="icon-searchengin"></i>
                    </form>
                    </div>
                    <div id="top-langs" style="display:none">

                            <ol class="breadcrumb breadcrumb_omg" style=" font-weight: bolder">
                            <?php
                                $lngg=config('app.locales');
                                $trans = config('app.locale_trans');
                            ?>
                            {{-- @foreach (config('app.locales') as $item => $name) --}}
                            @foreach ($data['lng'] as $item)
                            <li class="breadcrumb-item1" title="{{$item['lng_name']}}">
                            @if (Route::current()->getName() !== 'register' && Route::current()->getName() !== 'login' &&
                                 Route::current()->getName() !== 'faqs' && Route::current()->getName() !== 'index_page' &&
                                 Route::current()->getName() !== 'about_us')
                             @switch($data['call'])
                                 @case('archieve')
                                 <a href="{{route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$item['lng'],'date' => $data['date']]) }}"
                                        @if (app()->getLocale() == $item['lng']) style="display:none" @endif  >  &nbsp;
                                        {{ $item['lng_root'] }}

                                            @if (app()->getLocale() !== 'ru')
                                                @if (!$loop->last)  <span class="lang-divider"> |</span> @endif
                                            @else
                                                @if ($loop->first)  <span class="lang-divider"> |</span> @endif
                                            @endif
                                       </a>
                                     @break
                                 @case('single')
                                 <a href="{{route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$item['lng'],'unique_id' => $data['unique_id'],'title' => $data['title'] ]) }}"
                                        @if (app()->getLocale() == $item['lng']) style="display:none" @endif > &nbsp;
                                        {{ $item['lng_root']}}

                                            @if (app()->getLocale() !== 'ru')
                                                @if (!$loop->last)  <span class="lang-divider"> |</span> @endif
                                            @else
                                                @if ($loop->first)  <span class="lang-divider"> |</span> @endif
                                            @endif
                                       </a>
                                     @break
                                @case('tags')
                                <a href="{{url('/')}}"
                                    @if (app()->getLocale() == $item['lng']) style="display:none" @endif > &nbsp;
                                    {{ $item['lng_root'] }}

                                            @if (app()->getLocale() !== 'ru')
                                                @if (!$loop->last)  <span class="lang-divider"> |</span> @endif
                                            @else
                                                @if ($loop->first)  <span class="lang-divider"> |</span> @endif
                                            @endif
                                    </a>
                                    @break
                                @case('search')
                                <a href="{{url('/')}}"
                                    @if (app()->getLocale() == $item['lng']) style="display:none" @endif > &nbsp;
                                    {{ $item['lng_root'] }}

                                            @if (app()->getLocale() !== 'ru')
                                                @if (!$loop->last)  <span class="lang-divider"> |</span> @endif
                                            @else
                                                @if ($loop->first)  <span class="lang-divider"> |</span> @endif
                                            @endif
                                    </a>
                                    @break
                                @case('404')
                                <a href="{{url('/')}}"
                                    @if (app()->getLocale() == $item['lng']) style="display:none" @endif > &nbsp;
                                    {{ $item['lng_root'] }}

                                            @if (app()->getLocale() !== 'ru')
                                                @if (!$loop->last)  <span class="lang-divider"> |</span> @endif
                                            @else
                                                @if ($loop->first)  <span class="lang-divider"> |</span> @endif
                                            @endif
                                        </a>
                                        @break

                                 @default
                                 <a href="{{route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$item['lng'],'category_item_id' => $data['item_id'] ]) }}"
                                    @if (app()->getLocale() == $item['lng']) style="display:none" @endif > &nbsp;
                                    {{ $item['lng_root'] }}

                                            @if (app()->getLocale() !== 'ru')
                                                @if (!$loop->last)  <span class="lang-divider"> |</span> @endif
                                            @else
                                                @if ($loop->first)  <span class="lang-divider"> |</span> @endif
                                            @endif
                                       </a>
                             @endswitch

                             @else
                             <a href="{{route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$item['lng']]) }}"
                                    @if (app()->getLocale() == $item['lng'] ) style="display:none" @endif > &nbsp;
                                    {{ $item['lng_root'] }}

                                        @if (app()->getLocale() !== 'ru')
                                            @if (!$loop->last) <span class="lang-divider"> |</span> @endif
                                        @else
                                            @if ($loop->first)  <span class="lang-divider"> |</span> @endif
                                        @endif
                                    </a>
                             @endif

                            </li>
                            @endforeach
                            </ol>
                    </div>

                    <div class="drop-lang-wrap" style="display:none">
                        <select name="drop-lang" id="drop-lang" onchange="location = this.value;">

                            @foreach ($data['lng'] as $item)
                            @php( $current_route = '')


                                <option @if (app()->getLocale() === $item['lng']) selected class="drop-lang-selected" @endif
                                        @if (Route::current()->getName() !== 'register' && Route::current()->getName() !== 'login' &&
                                        Route::current()->getName() !== 'faqs' && Route::current()->getName() !== 'index_page' &&
                                        Route::current()->getName() !== 'about_us')
                                        @switch($data['call'])
                                        @case('archieve')

                                            value = {{route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$item['lng'],'date' => $data['date']]) }}
                                            @break
                                        @case('single')


                                            value = {{route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$item['lng'],'unique_id' => $data['unique_id'],'title' => $data['title'] ]) }}
                                            @break
                                        @case('tags')

                                            value = {{url('/')}}
                                            @break
                                        @case('search')

                                            value = {{url('/')}}
                                            @break
                                        @case('404')

                                            value = {{url('/')}}
                                            @break
                                        @default
                                        value = {{route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$item['lng'],'category_item_id' => $data['item_id'] ]) }}
                                        @endswitch

                                    @else
                                        value = {{route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$item['lng']])}}
                                    @endif

                                title={{$item['lng_name']}}>
                                {{ $item['lng_root'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>



            </nav>
            <div class="dropdown-lng" style="">
                <button class="dropdown-toggle" type="button" id="dropdown-lang-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="this.blur();">
                  lang
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdown-lang-btn">
                    @foreach ($data['lng'] as $item)


                    <a class="dropdown-item @if (app()->getLocale() === $item['lng']) active active-lang @endif"

                            @if (Route::current()->getName() !== 'register' && Route::current()->getName() !== 'login' &&
                                Route::current()->getName() !== 'faqs' && Route::current()->getName() !== 'index_page' &&
                                Route::current()->getName() !== 'about_us')
                                @switch($data['call'])
                                @case('archieve')

                                    href = {{route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$item['lng'],'date' => $data['date']]) }}
                                    @break
                                @case('single')


                                    href = {{route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$item['lng'],'unique_id' => $data['unique_id'],'title' => $data['title'] ]) }}
                                    @break
                                @case('tags')

                                    href = {{url('/')}}
                                    @break
                                @case('search')

                                    href = {{url('/')}}
                                    @break
                                @case('404')

                                    href = {{url('/')}}
                                    @break
                                @default
                                href = {{route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$item['lng'],'category_item_id' => $data['item_id'] ]) }}
                                @endswitch

                            @else
                                href = {{route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale'=>$item['lng']])}}
                            @endif

                        title={{$item['lng_name']}}>
                        {{ $item['lng_root'] }}
                    </a>
                    @endforeach
                </div>
                <script>
                    let langToggler = document.getElementById('dropdown-lang-btn');
                    langToggler.textContent = document.getElementsByClassName('active-lang')[0].textContent.trim();


                </script>
              </div><!-- END dropdown-lang -->

            </div>

            </div>

            </header>

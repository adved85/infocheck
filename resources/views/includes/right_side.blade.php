<div id="right-side">
    <a href="{{url(app()->getLocale().'/')}}">
        <div class="home_link" title="{{trans('text.home')}}">
                <i class="icon-line2-home"></i>
        </div>
    </a>

    <a href="{{route('faqs', app()->getLocale()) }}">
        <div class="faq_link" style="padding: 9px 17px;" title="{{trans('text.faqs')}}">
                <i class="icon-question"></i>
        </div>
    </a>

    @auth
        <a href="{{ route('logout', app()->getLocale()) }}" onclick="event.preventDefault(); document.getElementById('logout-form-right').submit();">
            <div class="logout_link" title=" {{Auth::user()->name}} / {{ __('login.Logout') }}">
                <i class="icon-line2-logout"></i>
            </div>
        </a>
        <form id="logout-form-right" action="{{ route('logout', app()->getLocale()) }}" method="POST" style="display: none;">
            @csrf
        </form>

    @else

        @if (Route::current()->getName() !== 'register')
        <a href="{{ route('register', app()->getLocale()) }}">
            <div class="regis_link" title="{{ __('register.Register') }}">
                <i class="icon-line2-user-follow"></i>
            </div>
        </a>
        @endif


        @if (Route::current()->getName() !== 'login')
        <a href="{{ route('login', app()->getLocale()) }}">
            <div class="login_link" title="{{ __('login.Login') }}">
                <i class="icon-line2-login"></i>
            </div>
        </a>
        @endif


    @endauth

</div>

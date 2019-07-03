<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Jquery CDN -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{asset('/css/picker.min.css')}}" /> --}}
    <link rel="stylesheet" href="{{asset('css/amsify.suggestags.css')}}">

    <style>
        body {
        overflow-x: hidden;
        background-color: #fff;
        }

        #sidebar-wrapper {
        min-height: 100vh;
        margin-left: -15rem;
        -webkit-transition: margin .25s ease-out;
        -moz-transition: margin .25s ease-out;
        -o-transition: margin .25s ease-out;
        transition: margin .25s ease-out;
        }

        #sidebar-wrapper .sidebar-heading {
        padding: 0.875rem 1.25rem;
        font-size: 1.2rem;
        }

        #sidebar-wrapper .list-group {
        width: 15rem;
        }

        #page-content-wrapper {
        min-width: 100vw;
        }

        #page-content-wrapper .navbar {
            padding: 0.6rem;
        }

        #wrapper.toggled #sidebar-wrapper {
        margin-left: 0;
        }
        #sidebar-wrapper .list-group a.list-group-item.list-group-item-action.bg-light.active {
            background-color: #dae0e5;
            border-color: rgba(0,0,0,.125);
            font-size: 1rem;
        }

        @media (min-width: 768px) {
            #sidebar-wrapper {
                margin-left: 0;
            }

            #page-content-wrapper {
                min-width: 0;
                width: 100%;
            }

            #wrapper.toggled #sidebar-wrapper {
                margin-left: -15rem;
            }
        }

        /* categories */
        .cat-sort-list, .cat-sort-description {
            width: 50%;
        }

        #pos_alert_success, #pos_alert_danger {
            display: none;
        }

        #cat_create_alert_success, #cat_create_alert_danger, #cat_create_alert_warning {
            display: none;
        }

        /* posts */
        .post-list-title-td {
            max-width: 12rem;
        }

    </style>
</head>
<body>
    {{-- <div id="app"></div> --}}
    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">
                <a class="sidebar-brand" href="{{ url('/', app()->getLocale()) }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

            </div>
            <div class="list-group list-group-flush Laravel" id="dash-list">
                <a href="{{ route('admin.index', app()->getLocale()) }}" class="list-group-item list-group-item-action bg-light" id="dashboard">Dashboard</a>
                <a href="{{ route('admin.question.index', app()->getLocale()) }}" class="list-group-item list-group-item-action bg-light" id="questions">Questions</a>
                <a href="{{ route('admin.answer.index', app()->getLocale()) }}" class="list-group-item list-group-item-action bg-light" id="answers">Answers</a>
                <a href="{{ route('admin.category.index', app()->getLocale()) }}" class="list-group-item list-group-item-action bg-light" id="categories">Categories</a>
                <a href="{{ route('admin.post.index', app()->getLocale()) }}" class="list-group-item list-group-item-action bg-light" id="posts">Posts</a>
                <a href="{{route('admin.comment.index', app()->getLocale()) }}" class="list-group-item list-group-item-action bg-light" id="comments">Comments</a>
                <a href="{{route('admin.user.index', app()->getLocale()) }}" class="list-group-item list-group-item-action bg-light" id="users">Users</a>
                <a href="{{route('admin.subscribe.index', app()->getLocale()) }}" class="list-group-item list-group-item-action bg-light" id="subscribers">Subscribers</a>
                <a href="{{route('admin.about.index', app()->getLocale()) }}" class="list-group-item list-group-item-action bg-light" id="about_us">About Us</a>
                <a href="{{route('admin.lang.index', app()->getLocale()) }}" class="list-group-item list-group-item-action bg-light" id="languages">Languages</a>

            </div>
        </div>
        <!-- /#sidebar-wrapper End -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
          <!-- /#sidebar-wrapper  navbar-laravel-->
            <nav class="navbar navbar-expand-md navbar-light bg-light border-bottom ">
                {{-- <div class="container"></div> --}}

                    <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Comments
                                    {{ App\Comment::where('approved',0)->count() }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Questions
                                    {{ App\Question::where('visible',0)->count() }}
                                </a>
                            </li> --}}
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Language Menu -->
                            {{-- @foreach (config('app.locales') as $locale => $name)
                                <li class="nav-item">
                                    <a class="nav-link"
                                    href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), $locale) }}"
                                        @if (app()->getLocale() == $locale) style="font-weight: bold; text-decoration: underline" @endif>
                                        {{ strtoupper($locale) }}
                                    </a>
                                </li>
                            @endforeach --}}

                            <!-- Lang-Menu from DB -->
                            @yield('lang_menu')



                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login', app()->getLocale()) }}">{{ __('login.Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register', app()->getLocale()) }}">{{ __('register.Register') }}</a>
                                    </li>
                                @endif
                            @else
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
                            @endguest
                        </ul>
                    </div>

            </nav>

            <div class="container-fluid">
                <main class="py-4 text-center">
                    @yield('content')
                </main>
            </div>

        </div>
        <!-- /#page-content-wrapper -->

    </div>

  <!-- CKEditor init -->
  {{-- <script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script> --}}
  <script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>

  <!-- tagging system -->
  <script src="{{asset('js/jquery.amsify.suggestags.js')}}" type="text/javascript"></script>


    <script>
        /* >Global (dashboard) */
        /* Menu Toggle Script */
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });

        /* highlight active menu-item */
        let darkClass = 'list-group-item-dark';
        let lightClass = 'bg-light';
        let page_name = {{$page_name}};
        page_name.classList.remove(lightClass);
        page_name.classList.add(darkClass);

        /* >Categories */
        /* add sortable functionality for Menu-items */
        jQuery("#sortable").sortable();
        jQuery("#sortable").disableSelection();


        jQuery("#save-cat-positions").on('click', function() {
            let positions = [];
            let lists = jQuery('#sortable .list-group-item');

            for (let index = 0; index < lists.length; index++) {
                const element = lists[index];
                let current = {'item_id':element.id, 'position' : index + 1}
                positions.push(current);
            }
            let url = '{{ route('admin.category.position.update', app()->getLocale() ) }}';
            var obj = {item_positions: positions};

            $.ajax({
                type: "POST",
                dataType: 'json',
                url: url,
                data: obj,

                success:function(data, status) {
                    console.log(status);
                    if(status === 'success') {
                        jQuery('#pos_alert_success').show();
                        reloadPage(3000);
                    }
                },
                error:function(data, status) {
                    console.log(status);
                    if (status === 'error') {
                        jQuery('#pos_alert_danger').show();
                        reloadPage(3000);
                    }
                }
            });

        });



        function reloadPage(afterMS) {
            setTimeout( function(){
                window.location.reload();
            }, afterMS);
        }


        jQuery('#create_category').on('click' , function() {
            let allData = {}; // {}
            let names = [];
            let statuses = [];
            let cat_inputs = jQuery('#langTabContent .new-cat');
            let i = 0,j = 0;

            for (let index = 0; index < cat_inputs.length; index++) {
                const element = cat_inputs[index];

                if (element.hasAttribute('data-lang-id')) {
                    names[i] = {'name': element.value, 'lang_id' : element.getAttribute('data-lang-id')}
                    allData['names'] = names;
                    i++;
                }
                if (element.hasAttribute('data-status')) {
                    names[j]['status'] = element.value
                    j++;
                }
                allData[element.name] = element.value;
            }

            // console.log(names);
            console.log(allData);
            let url = '{{ route('admin.category.store', app()->getLocale() ) }}';
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: url,
                data: allData,

                success:function(data, status) {
                    console.log(status);
                    console.log(data);

                    if(status === 'success') {
                        // console.log('data.warning -----',data.warning);
                        if (data.warning) {
                            jQuery('#cat_create_alert_warning').show();
                        }else{
                            jQuery('#cat_create_alert_success').show();
                        }
                        reloadPage(3000);
                    }
                },
                error:function(data, status) {
                    console.log(status);
                    console.log(data);
                    if (status === 'error') {
                        jQuery('#cat_create_alert_danger').show();
                        reloadPage(3000);
                    }
                }
            });
        })


        /* Posts */
        if (typeof tags !== 'undefined') {
            if (tags) {
                $('input[name="tags"]').amsifySuggestags({
                    type : 'amsify',
                    suggestions: tags,
                    afterAdd: function(value) {
                        console.log('after add all tags are into input ----');
                        console.log(document.getElementById('tags').value);
                    },
                    afterRemove: function(value) {
                        // after remove
                        console.log('after remove all tags are into input ----');
                        console.log(document.getElementById('tags').value);
                    },
                });
            }
        }

        /* prevent Submit on pushing ENTER on CREATION/TRANSLATE/UPDATE forms */
        $('#post_create_form').keydown(function(event) {
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
            }
        });

        $('#post_trans_form').keydown(function(event) {
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
            }
        });

        $('#post_update_form').keydown(function(event) {
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
            }
        });


        jQuery(document).ready(function() {
            let short_text = document.getElementById('short_text');
            let html_code = document.getElementById('html_code');
            let email_body = document.getElementById('email_body');
            if (short_text !== null) {
                CKEDITOR.replace('short_text', { height: 150 });
            }
            if (html_code !== null) {
                CKEDITOR.replace('html_code', { height: 150 });
            }

            if (email_body !== null) {
                CKEDITOR.replace('email_body', { height: 150 });
            }
        })


        function getStatusChangeValue(event) {
            // alert(event.target.checked);
            let id  = event.target.getAttribute('name');
            let inp = document.getElementById(`${id}`);
            if(event.target.checked) {
                inp.setAttribute('value', 1);
                console.log(inp);
                // alert(event.target.getAttribute('value'));
            }else{

                inp.setAttribute('value', 0);
                console.log(inp);
                // alert(event.target.getAttribute('value'));
            }
        }




        // $.get("http://localhost:8000/en/admin/category/15/edit/", function(data, status){
        // let url = '{{route('admin.category.edit', ['locale'=>app()->getLocale(),'id'=> 15])}}';
        // console.log(url);

        // jQuery.get(url, function(data, status){
        //     console.log(data);
        //     console.log('status', status)
        // });






    </script>
</body>
</html>

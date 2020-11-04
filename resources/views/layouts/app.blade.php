<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'StratizenAsk') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('/vendor/laratrust/img/logo.png') }}">

    <!-- Styles -->
    <link href="{{ asset(mix('laratrust.css', 'vendor/laratrust')) }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex" href="{{ route('home') }}">
                <div><img src="{{ asset('/vendor/laratrust/img/logo.png') }}" style="height:40px; border-right: 1px solid #333;" class="pr-3" a></div>
                    <div class="pl-3 pt-2" style="color:#000;">{{ config('app.name', 'StratizenAsk') }}</div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link pt-3" href="{{ route('login') }}" style="color: #000; font-size:16px;">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link pt-3" href="{{ route('register') }}" style="color: #000; font-size:16px;">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown pt-2">
                            
                                <a id="navbarDropdown" class="nav-link dropdown-toggle h6 pt-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color:#000">
                                <img src="{{ Storage::url('uploads/avatars/'. Auth::user()->id . '/' . Auth::user()->avatar . '') }}" class="rounded-circle pb-1 pr-1" style="height:30px;width:30px;float:left;" alt=""  onerror="this.src='uploads/avatars/avatar.png';">
                                        {{ Auth::user()->username }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('welcome',Auth::user()->id) }}">Welcome</a>
                                    <a class="dropdown-item" href="{{ route('home',Auth::user()->id) }}">Feed</a>
                                    <a class="dropdown-item" href="{{ route('profile',Auth::user()->id) }}">My Profile</a>
                                    <a class="dropdown-item" href="{{ route('users.edit',Auth::user()->id) }}">Edit Profile</a>
                                    <a class="dropdown-item" href="./chatify">Chat</a>
                                    @role('administrator')
                                    <a class="dropdown-item" href="{{ route('laratrust.roles-assignment.index') }}">Admin Panel</a>
                                    @endrole
                                    <a class="dropdown-item" href="{{ route('faq') }}">FAQs</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>

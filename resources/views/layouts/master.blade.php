<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Insta') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b2602dcbca.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm p-lg-0 p-sm-0 pl-2 p-0">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <div><img src="{{ asset('image/logo.png') }}" style="height: 60px"></div>
{{--                    {{ config('app.name', 'Insta') }}--}}
                </a>


                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <div class="d-flex justify-content-end align-items-baseline">
                            <li class="nav-item">
                                <a class="btn btn-sm btn-primary" href="{{ route('login') }}">{{ __('Log In') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item pl-2 pr-2">
                                    <a class="nav-link text-primary font-weight-bold" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        </div>
                    @else
                        <li class="nav-item dropdown dropleft">
                            <a id="navbarDropdown" class="nav-link pr-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img class="rounded-circle" style="height: 40px" src="{{ Auth::user()->profile->profileImage() }}">
                            </a>

                            <div class="dropdown-menu dropdown-menu-left position-absolute" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ asset(Auth::user()->username) }}">
                                    {{ Auth::user()->username }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ url('/') }}">
                                    Home
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ Auth::user()->username }}/edit">
                                    Edit Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ Auth::user()->username }}/password/edit">
                                    Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>


{{--                <ul class="navbar-nav ml-auto">--}}
{{--                    <!-- Authentication Links -->--}}
{{--                    @guest--}}
{{--                        <div class="d-flex justify-content-end align-items-baseline">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="btn btn-sm btn-primary" href="{{ route('login') }}">{{ __('Log In') }}</a>--}}
{{--                            </li>--}}
{{--                            @if (Route::has('register'))--}}
{{--                                <li class="nav-item pl-2 pr-2">--}}
{{--                                    <a class="nav-link text-primary font-weight-bold" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    @else--}}
{{--                        <li class="nav-item dropdown">--}}
{{--                            <a id="navbarDropdown" class="nav-link pr-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                                <img class="rounded-circle" style="height: 40px" src="{{ Auth::user()->profile->profileImage() }}">--}}
{{--                            </a>--}}

{{--                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
{{--                                <a class="" href="{{ Auth::user()->username }}">--}}
{{--                                    {{ __('My Profile') }}--}}
{{--                                </a>--}}
{{--                                <a class="" href="{{ route('logout') }}"--}}
{{--                                   onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--                                    {{ __('Logout') }}--}}
{{--                                </a>--}}

{{--                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
{{--                                    @csrf--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    @endguest--}}
{{--                </ul>--}}
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>

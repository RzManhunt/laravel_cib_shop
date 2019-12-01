<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CIB @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('css/main.css') }}"></script>
</head>
<body>
    <header class="row justify-content-center @yield('hero-header')">
        
        <div class="container-fluid py-3 @yield('nav-bg')">
        <nav class="p-0 navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container-fluid col-md-8 px-0">
                <a class="text-white font-weight-bold nav-title" href="{{ url('/') }}">
                    CONFECCIONES IB
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
                        <li class="nav-item">
                            <a href="{{ route('shop.index') }}" class="nav-link text-white font-weight-bold">
                                SHOP
                            </a>
                        </li>

                        @guest
                        <li class="nav-item">
                            <a href="#" class="nav-link pl-5 text-white font-weight-bold">
                                ABOUT
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link pl-5 text-white font-weight-bold" href="{{ route('login') }}">
                                {{ __('LOGIN') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link pl-5 text-white font-weight-bold" href="{{ route('register') }}">{{ __('REGISTER') }}</a>
                        </li>

                        @else
                        <li class="nav-item">
                            <a href="{{ route('cart.index') }}" class="nav-link pl-5 text-white font-weight-bold">
                                CART
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link pl-5 text-white font-weight-bold">
                                BLOG
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link pl-5 text-white font-weight-bold" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                {{ __('LOGOUT') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                            </form>
                        </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        </div>

        @section('header-content')
        @show
    </header>

    @section('content')
    @show

    <div class="mb-5"></div>
    
    @section('footer')
        <footer class="fixed-bottom row d-flex justify-content-center bg-dark">
            <div class="col-md-8 px-0 py-4 d-flex justify-content-between">
                <div class="text-white">Made by Luis Moreno</div>
                <div>
                    <a class="text-white" href="">1</a>
                    <a class="text-white pl-5" href="">2</a>
                    <a class="text-white pl-5" href="">3</a>
                    <a class="text-white pl-5" href="">4</a>
                </div>
            </div>
        </footer>
    @show

@yield('extra-js')

</body>
</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Karate') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/css/aos.css')}}">
        <!-- MAIN CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/tooplate-gymso-style.css')}}">
    </head>
    <body data-spy="scroll" data-target="#navbarNav" data-offset="50">
        <div id="app">
            <!-- MENU BAR -->
            <nav class="navbar navbar-expand-lg fixed-top">
                <div class="container">

                    <a class="navbar-brand" href="index.html">Karatê System</a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-lg-auto">
                            <li class="nav-item">
                                <a href="#home" class="nav-link smoothScroll">Home</a>
                            </li>

                            <li class="nav-item">
                                <a href="#about" class="nav-link smoothScroll">Sobre Nós</a>
                            </li>

                            <li class="nav-item">
                                <a href="#schedule" class="nav-link smoothScroll">Horários</a>
                            </li>

                            <li class="nav-item">
                                <a href="#contact" class="nav-link smoothScroll">Contato</a>
                            </li>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="ml-lg-3 navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-toggle="modal" data-target="#modalLogin">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-toggle="modal" data-target="#membershipForm">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <div class="dropdown">
                                        <button class="nav-link" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background: none; border: none;">
                                            {{ Auth::user()->name }}
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a href="#">Perfil</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                    <button class="btn" type="submit">Sair</button>
                                                </form>
                                            </li>
                                        </ul>
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

        <!-- INCLUDE SWEERALERT -->
        @include('sweetalert::alert')
        
        <!-- SCRIPTS -->
        <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('assets/js/aos.js')}}"></script>
        <script src="{{ asset('assets/js/smoothscroll.js')}}"></script>
        <script src="{{ asset('assets/js/custom.js')}}"></script>

    </body>
</html>

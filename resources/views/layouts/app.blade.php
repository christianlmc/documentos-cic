<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style type="text/css">
        body {
            background: rgba(214,214,214,1);
            background: -moz-linear-gradient(left, rgba(214,214,214,1) 0%, rgba(235,235,235,1) 100%);
            background: -webkit-gradient(left top, right top, color-stop(0%, rgba(214,214,214,1)), color-stop(100%, rgba(235,235,235,1)));
            background: -webkit-linear-gradient(left, rgba(214,214,214,1) 0%, rgba(235,235,235,1) 100%);
            background: -o-linear-gradient(left, rgba(214,214,214,1) 0%, rgba(235,235,235,1) 100%);
            background: -ms-linear-gradient(left, rgba(214,214,214,1) 0%, rgba(235,235,235,1) 100%);
            background: linear-gradient(to right, rgba(214,214,214,1) 0%, rgba(235,235,235,1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d6d6d6', endColorstr='#ebebeb', GradientType=1 );
        }
    </style>
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @if (Auth::user())
                            <li {{{ (Request::is('funcionario') ? 'class=active' : '') }}}>
                                <a href="{{url('/funcionario')}}">Funcionários</a>
                            </li>
                            <li {{{ (Request::is('imprimefolha') ? 'class=active' : '') }}}>
                                <a href="{{url('/imprimefolha')}}">Imprimir Folha de Ponto</a>
                            </li>
                            <li {{{ (Request::is('datasespeciais') ? 'class=active' : '') }}}>
                                <a href="{{url('/datasespeciais')}}">Folgas e Feriados</a>
                            </li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>

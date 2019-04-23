<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lightbox.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">

    <!-- Font Awesome icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/lightbox.js') }}"></script>
</head>
<!-- CSS -->
<style>
    html{
        position:relative;
        min-height: 100%;
    }
    body {
        margin-bottom: 60px;
        font-family: 'Roboto Slab', serif;
    }
    .container{
        margin-top: 80px;
        margin-bottom: 80px;
    }
    .image{
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
    }
    #description{
        resize: none;
        height: 80px;
    }
    #comment{
        resize: none;
        height: 50px;
    }
    .card{
        margin-top: 20px;
    }
    footer{
        position: absolute;
        bottom: 0;
        width: 100%;
        color: white;
        text-align: center;
        padding: 8px 16px;
    }
</style>
<body class="text-white bg-secondary">
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <span class="navbar-brand mb-0 h1">Free|TUBE</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <!-- Authentication Links -->
            @guest
                <div class="navbar-nav">   
                    <a class="{{ Request::is('/') ? 'nav-item nav-link active' : 'nav-item nav-link' }}" href="{{ url('/') }}">Home</a>
                </div> 
                <div class="navbar-nav">
                <li class="nav-item">
                    <a class="{{ Request::is('login') ? 'nav-item nav-link active' : 'nav-item nav-link' }}" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="{{ Request::is('register') ? 'nav-item nav-link active' : 'nav-item nav-link' }}" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif   
            @else
                <div class="navbar-nav">   
                    <a class="{{ Request::is('home') ? 'nav-item nav-link active' : 'nav-item nav-link' }}" href="{{ url('home') }}">Home</a>
                </div> 
                <div class="navbar-nav">
                    <a class="nav-item nav-link">Hello, {{Auth::user()->username}}</a> 
                    @if(Auth::user()->admin == 1)
                        <a class="{{ Request::is('admin') ? 'nav-item nav-link active' : 'nav-item nav-link' }}" href="{{ url('admin') }}">Dashboard</a>        
                    @endif
                    <a class="nav-item nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            @endguest  
        </div>
    </div>
    </nav>
        @yield('content')
    <footer class="bg-dark">
        <label>&copy; Free|TUBE {{now()->year}}</label>
    </footer> 
</body>
</html>
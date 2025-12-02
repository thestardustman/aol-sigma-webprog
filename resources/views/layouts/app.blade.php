<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SDG-HOPE</title>
    <!-- CSS Bootstrap dari Laravel UI -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    <div id="app">
        <!-- NAVBAR -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
        
        <!-- LOGIKA: Jika Guest (Belum Login) -->
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
                </li>
            @endif
        
        <!-- LOGIKA: Jika Sudah Login (Auth) -->
        @else
            <li class="nav-item"><a class="nav-link" href="{{ route('settings') }}">Setting</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('profile') }}">Profile</a></li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        @endguest

    </ul>
</div>

        <main class="py-4">
            @yield('content')
        </main>

        <!-- FOOTER -->
        <footer class="bg-light text-center py-4 mt-5 border-top">
            <div class="container">
                <a href="{{ route('about') }}">About Us</a><br>
                <span>Jl. Donasi No. 9, Jakarta (SDG Center)</span><br>
                <span>partnership@sdghope.com</span><br>
                <strong class="text-muted">Copyright © 2025 SDG-Hope. All Rights Reserved</strong>
            </div>
        </footer>
    </div>
</body>
</html>
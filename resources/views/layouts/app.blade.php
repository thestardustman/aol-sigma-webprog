<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SDG Donation') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts (Bootstrap 5) -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .hero-section { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 4rem 0; }
        .card-hover:hover { transform: translateY(-5px); transition: 0.3s; box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
            <div class="container">
                <!-- 1. Logo -->
                <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}" style="font-size: 1.5rem;">
                    <i class="bi bi-heart-fill"></i> SDG-HOPE
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto align-items-center">
                        <!-- Switch Bahasa -->
                        <li class="nav-item dropdown me-3">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                {{ app()->getLocale() == 'id' ? '🇮🇩 ID' : '🇺🇸 EN' }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('lang.switch', 'id') }}">Bahasa Indonesia</a>
                                <a class="dropdown-item" href="{{ route('lang.switch', 'en') }}">English</a>
                            </div>
                        </li>

                        <!-- 2. Profile/Login -->
                        @guest
                            <li class="nav-item">
                                <a class="btn btn-outline-primary rounded-pill px-4" href="{{ route('login') }}">{{ __('messages.login_signup') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle fw-bold" href="#" role="button" data-bs-toggle="dropdown">
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('messages.logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-dark text-white pt-5 pb-3 mt-auto">
            <div class="container">
                <div class="row">
                    <!-- Kiri -->
                    <div class="col-md-4 mb-4">
                        <h5 class="text-uppercase fw-bold text-primary mb-3">{{ __('messages.contact') }}</h5>
                        <p class="small mb-1"><i class="bi bi-geo-alt me-2"></i> Jl. Harapan Bangsa No. 10, Jakarta</p>
                        <p class="small mb-1"><i class="bi bi-telephone me-2"></i> +62 812-3456-7890</p>
                        <p class="small mb-1"><i class="bi bi-envelope me-2"></i> help@sdghope.com</p>
                    </div>
                    <!-- Tengah -->
                    <div class="col-md-4 mb-4 text-center">
                        <h5 class="text-uppercase fw-bold text-primary mb-3">{{ __('messages.copyright') }}</h5>
                        <p class="small">&copy; 2025 SDG-HOPE Foundation.<br>All Rights Reserved.</p>
                    </div>
                    <!-- Kanan -->
                    <div class="col-md-4 mb-4 text-md-end">
                        <h5 class="text-uppercase fw-bold text-primary mb-3">{{ __('messages.find_us') }}</h5>
                        <a href="#" class="text-white me-3 fs-5 text-decoration-none">Instagram</a>
                        <a href="#" class="text-white me-3 fs-5 text-decoration-none">Facebook</a>
                        <a href="#" class="text-white fs-5 text-decoration-none">Twitter</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
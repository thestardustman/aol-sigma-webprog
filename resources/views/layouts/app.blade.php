<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bantu.in</title>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <style>
        /* --- DESIGN SYSTEM (TETAP PREMIUM) --- */
        :root { --primary-color: #4F46E5; --secondary-color: #7C3AED; }
        body { font-family: 'Nunito', sans-serif; background-color: #F3F4F6; }
        
        /* Navbar */
        .navbar { backdrop-filter: blur(10px); background-color: rgba(255, 255, 255, 0.95) !important; }
        
        /* Card Premium */
        .card-std {
            border: none; border-radius: 1.25rem; background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); overflow: hidden;
            transition: all 0.3s ease;
        }
        .card-hover:hover { transform: translateY(-5px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); }

        /* Buttons */
        .btn-pill { border-radius: 9999px; padding: 0.75rem 2rem; font-weight: 700; text-transform: uppercase; font-size: 0.875rem; }
        .btn-primary { background: var(--primary-color); border: none; }
        .btn-primary:hover { background: #4338ca; }

        /* Footer */
        footer { background-color: #111827; }
        footer a:hover { color: white !important; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <div id="app" class="d-flex flex-column flex-grow-1">
        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-md navbar-light shadow-sm sticky-top py-3">
            <div class="container">
                <a class="navbar-brand fw-bold fs-3" href="{{ url('/') }}" style="color: var(--primary-color);">
                    SDG-HOPE
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navContent">
                    <ul class="navbar-nav ms-auto align-items-center">
    
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item ms-md-4">
                                    <a class="btn btn-outline-primary btn-pill btn-sm px-4" href="{{ route('login') }}">Masuk / Daftar</a>
                                </li>
                            @endif
                        @else
                            <!-- Jika SUDAH LOGIN, Munculkan Dropdown -->
                            <li class="nav-item dropdown ms-md-4">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle fw-bold text-dark" href="#" role="button" data-bs-toggle="dropdown">
                                    Hi, {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2 rounded-3">
                                    
                                    <!-- LINK KE PROFILE -->
                                    <a class="dropdown-item rounded-2 py-2" href="{{ route('profile') }}">
                                        <i class="bi bi-person me-2"></i> Profile Saya
                                    </a>
                                    
                                    <!-- LINK KE SETTINGS -->
                                    <a class="dropdown-item rounded-2 py-2" href="{{ route('settings') }}">
                                        <i class="bi bi-gear me-2"></i> Pengaturan
                                    </a>

                                    <hr class="dropdown-divider">

                                    <!-- LOGOUT -->
                                    <a class="dropdown-item rounded-2 py-2 text-danger fw-bold" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i> Keluar
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

        <!-- MAIN CONTENT -->
        <main class="flex-grow-1">
            @yield('content')
        </main>

        <!-- FOOTER -->
        <footer class="text-white py-5 mt-auto">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-md-4">
                        <h6 class="text-primary fw-bold text-uppercase mb-3">Kontak</h6>
                        <ul class="list-unstyled text-secondary small" style="line-height: 1.8;">
                            <li>Jl. SDG No. 1, Jakarta</li>
                            <li>+62 812-0000-0000</li>
                            <li>help@sdghope.com</li>
                        </ul>
                    </div>
                    <div class="col-md-4 text-center">
                        <h6 class="text-white fw-bold text-uppercase mb-3">SDG-HOPE</h6>
                        <p class="text-secondary small">&copy; 2025 Hak Cipta Dilindungi.</p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <h6 class="text-primary fw-bold text-uppercase mb-3">Sosial Media</h6>
                        <div class="d-flex justify-content-md-end gap-3">
                            <a href="#" class="text-secondary text-decoration-none small">Instagram</a>
                            <a href="#" class="text-secondary text-decoration-none small">Twitter</a>
                            <a href="#" class="text-secondary text-decoration-none small">Facebook</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
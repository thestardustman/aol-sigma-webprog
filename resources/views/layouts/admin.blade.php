<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - SemutHitam</title>
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700,800" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <style>
        :root { --primary-color: #4F46E5; --secondary-color: #7C3AED; }
        body { font-family: 'Nunito', sans-serif; background-color: #F3F4F6; }
        
        .admin-navbar {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .admin-nav-link {
            color: #6b7280;
            padding: 0.75rem 1.25rem;
            border-radius: 0.5rem;
            transition: all 0.2s;
            text-decoration: none;
            font-weight: 600;
        }
        .admin-nav-link:hover, .admin-nav-link.active {
            color: var(--primary-color);
            background: rgba(79, 70, 229, 0.1);
        }
        .admin-nav-link.active {
            background: var(--primary-color);
            color: white;
        }
        
        .card-admin {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .stat-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .stat-value { font-size: 2.5rem; font-weight: 800; color: var(--primary-color); }
        .stat-label { color: #6b7280; font-size: 0.875rem; }
        
        .list-item {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            padding: 1rem 1.25rem;
            margin-bottom: 0.5rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        .list-item:hover {
            border-color: var(--primary-color);
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.1);
        }
        .list-item-detail {
            background: #f9fafb;
            border: 1px solid var(--primary-color);
            border-radius: 0 0 0.75rem 0.75rem;
            margin-top: -0.5rem;
            margin-bottom: 0.5rem;
            padding: 1.5rem;
            display: none;
        }
        .list-item-detail.show { display: block; }

        .badge-pending { background: #f59e0b; color: #000; }
        .badge-approved { background: #10b981; color: white; }
        .badge-rejected { background: #ef4444; color: white; }
        
        .btn-approve { background: #10b981; border: none; color: white; }
        .btn-approve:hover { background: #059669; color: white; }
        .btn-reject { background: #ef4444; border: none; color: white; }
        .btn-reject:hover { background: #dc2626; color: white; }
    </style>
</head>
<body>
    <nav class="admin-navbar py-3 sticky-top">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between">
                <!-- Left: Brand -->
                <a href="{{ route('admin.dashboard') }}" class="text-decoration-none fw-bold fs-4" style="color: var(--primary-color);">
                    <i class="bi bi-shield-check me-2"></i>SemutHitam
                </a>
                
                <!-- Center: Nav Links -->
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.users') }}" class="admin-nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                        <i class="bi bi-people me-1"></i> Users
                    </a>
                    <a href="{{ route('admin.campaigns') }}" class="admin-nav-link {{ request()->routeIs('admin.campaigns*') ? 'active' : '' }}">
                        <i class="bi bi-megaphone me-1"></i> Campaigns
                    </a>
                    <a href="{{ route('admin.approvals') }}" class="admin-nav-link {{ request()->routeIs('admin.approvals') ? 'active' : '' }}">
                        <i class="bi bi-check-circle me-1"></i> Approvals
                        @php
                            $pendingCount = \App\Models\User::where('kyc_status', 'pending')->count() + \App\Models\Proposal::where('status', 'pending')->count();
                        @endphp
                        @if($pendingCount > 0)
                            <span class="badge bg-danger ms-1">{{ $pendingCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.history') }}" class="admin-nav-link {{ request()->routeIs('admin.history') ? 'active' : '' }}">
                        <i class="bi bi-clock-history me-1"></i> History
                    </a>
                </div>
                
                <!-- Right: Admin Info -->
                <div class="dropdown">
                    <a class="text-dark text-decoration-none dropdown-toggle fw-bold" href="#" data-bs-toggle="dropdown">
                        Hi, {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                        <li><a class="dropdown-item" href="{{ route('home') }}"><i class="bi bi-house me-2"></i>Back to Site</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container-fluid px-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @yield('content')
        </div>
    </main>

    <script>
        function toggleDetail(id) {
            const detail = document.getElementById('detail-' + id);
            const allDetails = document.querySelectorAll('.list-item-detail');
            
            allDetails.forEach(d => {
                if (d.id !== 'detail-' + id) {
                    d.classList.remove('show');
                }
            });
            
            detail.classList.toggle('show');
        }
    </script>
    @stack('scripts')
</body>
</html>

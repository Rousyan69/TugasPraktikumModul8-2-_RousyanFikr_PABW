<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Portal Desa') — SmartResident</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --sr-primary: #059669;
            --sr-primary-dark: #047857;
            --sr-primary-soft: #ecfdf5;
            --sr-slate-900: #0f172a;
            --sr-slate-600: #475569;
            --sr-bg: #f1f5f9;
        }
        body {
            background-color: var(--sr-bg);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--sr-slate-900);
        }
        .navbar-civic {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #e2e8f0;
        }
        .brand-icon {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, #10b981, #047857);
            color: #fff;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(5, 150, 105, 0.25);
        }
        .nav-link-sr {
            color: var(--sr-slate-600);
            font-weight: 600;
            font-size: 0.92rem;
            padding: 0.55rem 1rem !important;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .nav-link-sr:hover {
            background-color: #f8fafc;
            color: var(--sr-primary);
        }
        .nav-link-sr.active {
            background-color: var(--sr-primary-soft);
            color: var(--sr-primary-dark);
        }
        .card-sr {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.04);
        }
        .btn-sr-primary {
            background-color: var(--sr-primary);
            border-color: var(--sr-primary);
            color: #fff;
            font-weight: 600;
            border-radius: 10px;
            padding: 0.55rem 1.2rem;
            box-shadow: 0 2px 6px rgba(5, 150, 105, 0.25);
            transition: all 0.2s;
        }
        .btn-sr-primary:hover {
            background-color: var(--sr-primary-dark);
            border-color: var(--sr-primary-dark);
            color: #fff;
            transform: translateY(-1px);
        }
        .table-sr thead th {
            background-color: #f8fafc;
            color: #64748b;
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.9rem 1rem;
        }
        .table-sr tbody td {
            padding: 0.95rem 1rem;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.92rem;
        }
        .badge-soft-success { background: #dcfce7; color: #166534; font-weight: 600; }
        .badge-soft-warning { background: #fef3c7; color: #92400e; font-weight: 600; }
        .badge-soft-danger  { background: #fee2e2; color: #991b1b; font-weight: 600; }
        .badge-soft-info    { background: #e0f2fe; color: #075985; font-weight: 600; }
        .badge-soft-slate   { background: #f1f5f9; color: #334155; font-weight: 600; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-civic sticky-top py-2">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-dark" href="{{ route('dashboard') }}">
                <span class="brand-icon"><i class="bi bi-buildings-fill fs-5"></i></span>
                <div class="lh-1">
                    <span class="d-block fs-6 fw-bolder tracking-tight">SmartResident</span>
                    <small class="text-muted fw-medium" style="font-size: 0.7rem;">Smart Village Infrastructure</small>
                </div>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#srNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="srNav">
                <ul class="navbar-nav me-auto ms-lg-4 gap-1 my-2 my-lg-0">
                    <li class="nav-item">
                        <a class="nav-link nav-link-sr {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="bi bi-grid-1x2-fill me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-sr {{ request()->routeIs('infrastruktur.*') ? 'active' : '' }}" href="{{ route('infrastruktur.index') }}">
                            <i class="bi bi-cone-striped me-1"></i> Aset Infrastruktur
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-sr {{ request()->routeIs('aduan.*') ? 'active' : '' }}" href="{{ route('aduan.index') }}">
                            <i class="bi bi-megaphone-fill me-1"></i> Aduan Warga <span class="badge rounded-pill bg-success ms-1" style="font-size: 0.65rem;">AJAX</span>
                        </a>
                    </li>
                </ul>

                @auth
                <div class="dropdown">
                    <button class="btn btn-light border rounded-pill px-3 py-1 d-flex align-items-center gap-2 dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <span class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center fw-bold" style="width:28px;height:28px;font-size:0.8rem;">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </span>
                        <span class="fw-semibold small">{{ auth()->user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2 mt-2" style="min-width: 230px;">
                        <li class="px-3 py-2">
                            <div class="fw-bold small">{{ auth()->user()->name }}</div>
                            <div class="text-muted" style="font-size: 0.75rem;">{{ auth()->user()->email }}</div>
                            <span class="badge badge-soft-success mt-1">{{ auth()->user()->role->label() }}</span>
                        </li>
                        <li><hr class="dropdown-divider my-1"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item rounded-3 text-danger fw-semibold small py-2">
                                    <i class="bi bi-box-arrow-right me-2"></i>Keluar Sistem
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @if (session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-3 alert-dismissible fade show d-flex align-items-center" role="alert">
                <i class="bi bi-check-circle-fill fs-5 me-2 text-success"></i>
                <div class="fw-medium">{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="container py-4 mt-4 border-top text-center text-muted small">
        &copy; {{ date('Y') }} <strong>SmartResident</strong> — Sistem Pelaporan Infrastruktur Desa Terpadu.
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
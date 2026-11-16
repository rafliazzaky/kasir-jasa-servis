<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Kasir Bengkel')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Google Font: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-app: #f8fafc;
            --sidebar-bg: #0f172a;
            --sidebar-hover: #1e293b;
            --primary-accent: #2563eb;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --card-border: #f1f5f9;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--bg-app);
            color: var(--text-main);
            letter-spacing: -0.01em;
        }

        /* Sidebar Styling */
        .sidebar {
            min-height: 100vh;
            background-color: var(--sidebar-bg);
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }

        .brand-logo {
            font-weight: 800;
            font-size: 1.15rem;
            color: #ffffff;
            letter-spacing: -0.02em;
        }

        .sidebar .nav-link {
            color: #94a3b8;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 10px 14px;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .sidebar .nav-link i {
            width: 22px;
            font-size: 1.05rem;
            transition: transform 0.2s ease;
        }

        .sidebar .nav-link:hover {
            color: #f8fafc;
            background-color: var(--sidebar-hover);
        }

        .sidebar .nav-link:hover i {
            transform: translateX(2px);
        }

        .sidebar .nav-link.active {
            color: #ffffff;
            background-color: var(--primary-accent);
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
        }

        /* Card Modernization */
        .card {
            border: 1px solid var(--card-border) !important;
            border-radius: 14px !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.02), 0 1px 2px -1px rgba(0, 0, 0, 0.02) !important;
            transition: box-shadow 0.2s ease;
        }

        .card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.04), 0 4px 6px -4px rgba(0, 0, 0, 0.02) !important;
        }

        /* Table Modernization */
        .table {
            color: var(--text-main);
            font-size: 0.9rem;
        }

        .table thead th {
            background-color: #f8fafc;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid #e2e8f0;
            padding: 12px 16px;
        }

        .table tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
        }

        /* Custom Soft Badges */
        .badge-soft-primary { background-color: #eff6ff; color: #1d4ed8; font-weight: 600; }
        .badge-soft-success { background-color: #f0fdf4; color: #15803d; font-weight: 600; }
        .badge-soft-dark { background-color: #f1f5f9; color: #334155; font-weight: 600; }

        /* Custom Buttons */
        .btn {
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 9px 18px;
        }

        .btn-primary {
            background-color: var(--primary-accent);
            border-color: var(--primary-accent);
            box-shadow: 0 2px 6px rgba(37, 99, 235, 0.25);
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
        }

        .user-profile-box {
            background-color: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Navigation -->
            <div class="col-md-3 col-lg-2 sidebar p-3 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center gap-2 my-3 px-2">
                        <div class="bg-primary rounded-3 p-2 d-flex align-items-center justify-content-center text-white" style="width: 36px; height: 36px;">
                            <i class="fa-solid fa-wrench"></i>
                        </div>
                        <span class="brand-logo">BengkelSys</span>
                    </div>
                    
                    <hr class="border-secondary opacity-25 my-3">
                    
                    <ul class="nav nav-pills flex-column gap-1">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                                <i class="fa-solid fa-chart-pie me-2"></i> Dashboard
                            </a>
                        </li>
                        @if(Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a href="{{ route('services.index') }}" class="nav-link {{ request()->is('services*') ? 'active' : '' }}">
                                <i class="fa-solid fa-layer-group me-2"></i> Kelola Jasa
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.index') }}" class="nav-link {{ request()->is('reports*') ? 'active' : '' }}">
                                <i class="fa-solid fa-wallet me-2"></i> Laporan Laba
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('transactions.create') }}" class="nav-link {{ request()->is('transactions*') ? 'active' : '' }}">
                                <i class="fa-solid fa-receipt me-2"></i> Transaksi Kasir
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- User Profile & Logout -->
                <div class="pt-3">
                    <div class="user-profile-box p-3 mb-2">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <span class="text-white fw-semibold small text-truncate">{{ Auth::user()->name }}</span>
                            <span class="badge {{ Auth::user()->role === 'admin' ? 'badge-soft-primary' : 'badge-soft-dark' }} px-2 py-1" style="font-size: 0.68rem;">
                                {{ strtoupper(Auth::user()->role) }}
                            </span>
                        </div>
                        <small class="text-muted d-block" style="font-size: 0.75rem;">{{ Auth::user()->email }}</small>
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm w-100 py-2" style="border-radius: 10px;">
                            <i class="fa-solid fa-arrow-right-from-bracket me-1"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>

            <!-- Content Area -->
            <div class="col-md-9 col-lg-10 p-4 p-md-5">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - Raqoon Cafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 260px;
            --primary: #1a1a2e;
            --accent: #ff9e81;
        }
        body { background: #f4f6fb; font-family: 'Segoe UI', system-ui, sans-serif; }
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--primary);
            position: fixed;
            left: 0;
            top: 0;
            z-index: 100;
            transition: transform .3s;
        }
        .sidebar .brand {
            padding: 1.5rem;
            font-size: 1.3rem;
            font-weight: 700;
            color: #fff;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .sidebar .brand span { color: var(--accent); }
        .sidebar .nav-link {
            color: rgba(255,255,255,.65);
            padding: .75rem 1.5rem;
            font-size: .925rem;
            border-left: 3px solid transparent;
            transition: all .2s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #fff;
            background: rgba(255,255,255,.05);
            border-left-color: var(--accent);
        }
        .sidebar .nav-link i { width: 24px; margin-right: .5rem; }
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
        }
        .topbar {
            background: #fff;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,.06);
        }
        .btn-accent { background: var(--accent); color: #fff; border: none; }
        .btn-accent:hover { background: #f0896c; color: #fff; }
        .table th { font-weight: 600; font-size: .85rem; text-transform: uppercase; color: #6b7280; }
        .badge-active { background: #10b981; }
        .badge-inactive { background: #6b7280; }
        .sortable-ghost { opacity: 0.4; background: #f0f0ff; }
        .drag-handle { cursor: grab; color: #adb5bd; }
        .drag-handle:active { cursor: grabbing; }
        @media (max-width: 991px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <span>Raqoon</span> Cafe
        </div>
        <nav class="mt-3">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>
            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="bi bi-collection-fill"></i> Kategoriler
            </a>
            <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam-fill"></i> Ürünler
            </a>
            <a href="{{ route('admin.social-links.index') }}" class="nav-link {{ request()->routeIs('admin.social-links.*') ? 'active' : '' }}">
                <i class="bi bi-share-fill"></i> Sosyal Medya
            </a>
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i> Kullanıcılar
            </a>
            <a href="{{ route('admin.change-password') }}" class="nav-link {{ request()->routeIs('admin.change-password') ? 'active' : '' }}">
                <i class="bi bi-key-fill"></i> Şifre Değiştir
            </a>
            <a href="{{ route('menu') }}" target="_blank" class="nav-link">
                <i class="bi bi-phone-fill"></i> Menüyü Gör
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <div class="topbar">
            <div>
                <button class="btn btn-sm btn-outline-secondary d-lg-none me-2" onclick="document.getElementById('sidebar').classList.toggle('show')">
                    <i class="bi bi-list"></i>
                </button>
                <strong>@yield('title', 'Dashboard')</strong>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-box-arrow-right"></i> Çıkış
                </button>
            </form>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>
    @stack('scripts')
</body>
</html>

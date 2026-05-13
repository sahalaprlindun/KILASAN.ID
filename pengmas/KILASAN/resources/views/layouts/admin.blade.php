<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin KILASAN')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        :root { --umb-blue: #005B9F; --umb-green: #28A47B; --umb-green-dark: #1F8A67; }
        body { background: #f4f7fc; font-family: Inter, system-ui, sans-serif; overflow-x: hidden; }
        .admin-shell { min-height: 100vh; display: flex; }
        .sidebar { width: 280px; background: linear-gradient(145deg, #0b2b3f 0%, #0a2a3a 100%); color: white; padding: 28px 16px; flex-shrink: 0; box-shadow: 4px 0 20px rgba(0,0,0,.18); }
        .sidebar a, .sidebar button { color: #cfdfed; text-decoration: none; width: 100%; text-align: left; border: 0; background: transparent; padding: 12px 18px; border-radius: 16px; display: block; font-weight: 500; transition: .2s; }
        .sidebar a.active, .sidebar a:hover, .sidebar button:hover { background: var(--umb-green); color: white; transform: translateX(4px); }
        .main { flex: 1; padding: 28px 36px; overflow-x: auto; }
        .stat-card, .panel { background: white; border-radius: 28px; padding: 20px; box-shadow: 0 10px 25px rgba(0,0,0,.04); border: 1px solid rgba(0,0,0,.02); }
        .stat-value { font-size: 2rem; font-weight: 800; color: #1a3c5c; }
        .btn-primary { background: var(--umb-green); border-color: var(--umb-green); border-radius: 40px; }
        .btn-primary:hover { background: var(--umb-green-dark); border-color: var(--umb-green-dark); }
        .table-responsive { background: white; border-radius: 24px; padding: 12px; }
        .form-control, .form-select { border-radius: 30px; }
        @media (max-width: 900px) { .admin-shell { display: block; } .sidebar { width: 100%; } }
    </style>
</head>
<body>
<div class="admin-shell">
    <aside class="sidebar">
        <div class="mb-4">
            <h3 class="fw-bold mb-0">KILASAN.id</h3>
            <small class="text-white-50">{{ auth()->user()->username }} - {{ auth()->user()->role }}</small>
        </div>
        <a class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="fas fa-chart-line me-2"></i>Dashboard</a>
        <a class="{{ request()->routeIs('admin.complaints.*') ? 'active' : '' }}" href="{{ route('admin.complaints.index') }}"><i class="fas fa-clipboard-list me-2"></i>Data Pengaduan</a>
        @if (auth()->user()->isSuperadmin())
            <a class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}"><i class="fas fa-user-shield me-2"></i>Data Petugas</a>
            <a class="{{ request()->routeIs('admin.feedback.*') ? 'active' : '' }}" href="{{ route('admin.feedback.index') }}"><i class="fas fa-comment-dots me-2"></i>Feedback</a>
        @endif
        <a class="{{ request()->routeIs('admin.profile.*') ? 'active' : '' }}" href="{{ route('admin.profile.edit') }}"><i class="fas fa-user-cog me-2"></i>Profil</a>
        <form method="post" action="{{ route('logout') }}" class="mt-3">@csrf<button><i class="fas fa-sign-out-alt me-2"></i>Logout</button></form>
    </aside>
    <main class="main">
        @if (session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        @if ($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
        @yield('content')
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>

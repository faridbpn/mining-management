<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Aplikasi Tambang') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .navbar-brand { font-weight: bold; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Aplikasi Tambang</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth
                    @if(Auth::user()->isAdmin())
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.bookings.index') }}">Pemesanan</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.vehicles.index') }}">Kendaraan</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.drivers.index') }}">Driver</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.reports') }}">Laporan</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.activity-logs.index') }}">Log Aktivitas</a></li>
                    @elseif(Auth::user()->isApprover())
                        <li class="nav-item"><a class="nav-link" href="{{ route('approver.dashboard') }}">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('approver.approvals.index') }}">Daftar Persetujuan</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('approver.history') }}">Riwayat Persetujuan</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('employee.dashboard') }}">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('employee.bookings.index') }}">Pemesanan Saya</a></li>
                    @endif
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="nav-link btn btn-link p-0" style="border:none;background:none;">Logout</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html> 
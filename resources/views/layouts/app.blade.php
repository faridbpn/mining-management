<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Aplikasi Tambang') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
<nav class="bg-blue-700 text-white shadow mb-6">
    <div class="container mx-auto px-4 flex flex-wrap items-center justify-between py-3">
        <a class="font-bold text-lg" href="{{ route('home') }}">Aplikasi Tambang</a>
        <button class="block md:hidden text-white focus:outline-none" id="nav-toggle">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
        <div class="w-full md:flex md:items-center md:w-auto hidden" id="nav-content">
            <ul class="md:flex md:space-x-4 md:items-center text-base pt-4 md:pt-0">
                @auth
                    @if(Auth::user()->isAdmin())
                        <li><a class="block py-2 px-4 hover:bg-blue-800 rounded transition" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a class="block py-2 px-4 hover:bg-blue-800 rounded transition" href="{{ route('admin.bookings.index') }}">Pemesanan</a></li>
                        <li><a class="block py-2 px-4 hover:bg-blue-800 rounded transition" href="{{ route('admin.vehicles.index') }}">Kendaraan</a></li>
                        <li><a class="block py-2 px-4 hover:bg-blue-800 rounded transition" href="{{ route('admin.drivers.index') }}">Driver</a></li>
                        <li><a class="block py-2 px-4 hover:bg-blue-800 rounded transition" href="{{ route('admin.reports') }}">Laporan</a></li>
                        <li><a class="block py-2 px-4 hover:bg-blue-800 rounded transition" href="{{ route('admin.activity-logs.index') }}">Log Aktivitas</a></li>
                    @elseif(Auth::user()->isApprover())
                        <li><a class="block py-2 px-4 hover:bg-blue-800 rounded transition" href="{{ route('approver.dashboard') }}">Dashboard</a></li>
                        <li><a class="block py-2 px-4 hover:bg-blue-800 rounded transition" href="{{ route('approver.approvals.index') }}">Daftar Persetujuan</a></li>
                        <li><a class="block py-2 px-4 hover:bg-blue-800 rounded transition" href="{{ route('approver.history') }}">Riwayat Persetujuan</a></li>
                    @else
                        <li><a class="block py-2 px-4 hover:bg-blue-800 rounded transition" href="{{ route('employee.dashboard') }}">Dashboard</a></li>
                        <li><a class="block py-2 px-4 hover:bg-blue-800 rounded transition" href="{{ route('employee.bookings.index') }}">Pemesanan Saya</a></li>
                    @endif
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button class="block py-2 px-4 hover:bg-blue-800 rounded transition w-full text-left">Logout</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<div class="container mx-auto px-4">
    @yield('content')
</div>
<script>
    // Navbar toggle
    document.getElementById('nav-toggle').onclick = function(){
        var nav = document.getElementById('nav-content');
        nav.classList.toggle('hidden');
    };
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: @json(session('success')),
            timer: 2000,
            showConfirmButton: false
        });
    @endif
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: @json(session('error')),
            timer: 2500,
            showConfirmButton: false
        });
    @endif
</script>
@yield('scripts')
</body>
</html> 
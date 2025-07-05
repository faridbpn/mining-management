@extends('layouts.app')
@section('content')
<div class="flex items-center justify-center min-h-[80vh] bg-gray-100">
    <div class="w-full max-w-lg bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-2xl font-bold mb-6 text-blue-700 flex items-center gap-2">
            <svg xmlns='http://www.w3.org/2000/svg' class='h-7 w-7 text-blue-700' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 6h16M4 12h16M4 18h16'></path></svg>
            Detail Driver
        </h2>
        <div class="space-y-4">
            <div class="flex justify-between items-center">
                <span class="font-semibold">Nama:</span>
                <span>{{ $driver->name }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="font-semibold">Telepon:</span>
                <span>{{ $driver->phone }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="font-semibold">Lokasi:</span>
                <span>{{ $driver->location->name ?? '-' }}</span>
            </div>
        </div>
        <div class="mt-8 flex gap-2">
            <a href="{{ route('admin.drivers.edit', $driver) }}" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-4 py-2 rounded font-semibold">Edit</a>
            <a href="{{ route('admin.drivers.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded font-semibold">Kembali</a>
        </div>
    </div>
</div>
@endsection 
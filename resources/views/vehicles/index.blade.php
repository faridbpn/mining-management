@extends('layouts.app')
@section('content')
<h1 class="mb-4 text-2xl font-bold">Daftar Kendaraan</h1>
<a href="{{ route('admin.vehicles.create') }}" class="btn btn-primary mb-3 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Tambah Kendaraan</a>
<div class="overflow-x-auto">
<table class="min-w-full bg-white rounded shadow">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-2">Nama</th>
            <th class="px-4 py-2">Tipe</th>
            <th class="px-4 py-2">Kepemilikan</th>
            <th class="px-4 py-2">Lokasi</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vehicles as $vehicle)
        <tr>
            <td class="px-4 py-2">{{ $vehicle->name }}</td>
            <td class="px-4 py-2">
                <span class="inline-block px-2 py-1 rounded text-xs font-semibold {{ $vehicle->type == 'passenger' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700' }}">
                    {{ ucfirst($vehicle->type) }}
                </span>
            </td>
            <td class="px-4 py-2">
                <span class="inline-block px-2 py-1 rounded text-xs font-semibold {{ $vehicle->ownership == 'owned' ? 'bg-gray-200 text-gray-800' : 'bg-yellow-100 text-yellow-800' }}">
                    {{ $vehicle->ownership == 'owned' ? 'Milik Perusahaan' : 'Sewa' }}
                </span>
            </td>
            <td class="px-4 py-2">{{ $vehicle->location->name ?? '-' }}</td>
            <td class="px-4 py-2 flex gap-1">
                <a href="{{ route('admin.vehicles.show', $vehicle) }}" class="btn btn-info btn-sm bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded">Detail</a>
                <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="btn btn-warning btn-sm bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-2 py-1 rounded">Edit</a>
                <form action="{{ route('admin.vehicles.destroy', $vehicle) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection 
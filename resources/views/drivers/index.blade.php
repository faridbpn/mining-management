@extends('layouts.app')
@section('content')
<h1 class="mb-4 text-2xl font-bold">Daftar Driver</h1>
<a href="{{ route('admin.drivers.create') }}" class="btn btn-primary mb-3 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Tambah Driver</a>
<div class="overflow-x-auto">
<table class="min-w-full bg-white rounded shadow">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-2">Nama</th>
            <th class="px-4 py-2">Telepon</th>
            <th class="px-4 py-2">Lokasi</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($drivers as $driver)
        <tr>
            <td class="px-4 py-2">{{ $driver->name }}</td>
            <td class="px-4 py-2">{{ $driver->phone }}</td>
            <td class="px-4 py-2">{{ $driver->location->name ?? '-' }}</td>
            <td class="px-4 py-2 flex gap-1">
                <a href="{{ route('admin.drivers.show', $driver) }}" class="btn btn-info btn-sm bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded">Detail</a>
                <a href="{{ route('admin.drivers.edit', $driver) }}" class="btn btn-warning btn-sm bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-2 py-1 rounded">Edit</a>
                <form action="{{ route('admin.drivers.destroy', $driver) }}" method="POST" class="d-inline">
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
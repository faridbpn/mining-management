@extends('layouts.app')
@section('content')
<h1 class="mb-4">Daftar Driver</h1>
<a href="{{ route('admin.drivers.create') }}" class="btn btn-primary mb-3">Tambah Driver</a>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Telepon</th>
            <th>Lokasi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($drivers as $driver)
        <tr>
            <td>{{ $driver->name }}</td>
            <td>{{ $driver->phone }}</td>
            <td>{{ $driver->location->name ?? '-' }}</td>
            <td>
                <a href="{{ route('admin.drivers.show', $driver) }}" class="btn btn-info btn-sm">Detail</a>
                <a href="{{ route('admin.drivers.edit', $driver) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.drivers.destroy', $driver) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection 
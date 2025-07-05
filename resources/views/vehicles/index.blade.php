@extends('layouts.app')
@section('content')
<h1 class="mb-4">Daftar Kendaraan</h1>
<a href="{{ route('vehicles.create') }}" class="btn btn-primary mb-3">Tambah Kendaraan</a>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Kepemilikan</th>
            <th>Plat Nomor</th>
            <th>Lokasi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vehicles as $vehicle)
        <tr>
            <td>{{ $vehicle->name }}</td>
            <td>{{ $vehicle->type }}</td>
            <td>{{ $vehicle->ownership }}</td>
            <td>{{ $vehicle->plate_number }}</td>
            <td>{{ $vehicle->location->name ?? '-' }}</td>
            <td>
                <a href="{{ route('vehicles.show', $vehicle) }}" class="btn btn-info btn-sm">Detail</a>
                <a href="{{ route('vehicles.edit', $vehicle) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection 
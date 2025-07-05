@extends('layouts.app')
@section('content')
<h1 class="mb-4 text-2xl font-bold">Daftar Pemesanan Kendaraan</h1>
<a href="{{ route('admin.bookings.create') }}" class="btn btn-primary mb-3 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Tambah Pemesanan</a>
<div class="overflow-x-auto">
<table class="table table-bordered table-striped min-w-full bg-white rounded shadow">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-2">Pegawai</th>
            <th class="px-4 py-2">Kendaraan</th>
            <th class="px-4 py-2">Driver</th>
            <th class="px-4 py-2">Tujuan</th>
            <th class="px-4 py-2">Tanggal</th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $booking)
        <tr>
            <td class="px-4 py-2">{{ $booking->user->name ?? '-' }}</td>
            <td class="px-4 py-2">{{ $booking->vehicle->name ?? '-' }}</td>
            <td class="px-4 py-2">{{ $booking->driver->name ?? '-' }}</td>
            <td class="px-4 py-2">{{ $booking->destination }}</td>
            <td class="px-4 py-2">{{ $booking->start_time->format('d/m/Y H:i') }}</td>
            <td class="px-4 py-2">
                @if($booking->status == 'pending')
                    <span class="badge bg-warning text-yellow-800">Menunggu Persetujuan</span>
                @elseif($booking->status == 'approved')
                    <span class="badge bg-success text-green-800">Disetujui</span>
                @elseif($booking->status == 'rejected')
                    <span class="badge bg-danger text-red-800">Ditolak</span>
                @else
                    <span class="badge bg-secondary">{{ $booking->status }}</span>
                @endif
            </td>
            <td class="px-4 py-2 flex gap-1">
                <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-info btn-sm bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded">Detail</a>
                <a href="{{ route('admin.bookings.edit', $booking) }}" class="btn btn-warning btn-sm bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-2 py-1 rounded">Edit</a>
                <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" class="d-inline">
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
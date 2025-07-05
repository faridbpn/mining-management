@extends('layouts.app')
@section('content')
<h1 class="mb-4">Daftar Pemesanan Kendaraan</h1>
<a href="{{ route('admin.bookings.create') }}" class="btn btn-primary mb-3">Tambah Pemesanan</a>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Pegawai</th>
            <th>Kendaraan</th>
            <th>Driver</th>
            <th>Tujuan</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $booking)
        <tr>
            <td>{{ $booking->user->name ?? '-' }}</td>
            <td>{{ $booking->vehicle->name ?? '-' }}</td>
            <td>{{ $booking->driver->name ?? '-' }}</td>
            <td>{{ $booking->destination }}</td>
            <td>{{ $booking->start_time->format('d/m/Y H:i') }}</td>
            <td>
                @if($booking->status == 'pending')
                    <span class="badge bg-warning">Menunggu Persetujuan</span>
                @elseif($booking->status == 'approved')
                    <span class="badge bg-success">Disetujui</span>
                @elseif($booking->status == 'rejected')
                    <span class="badge bg-danger">Ditolak</span>
                @else
                    <span class="badge bg-secondary">{{ $booking->status }}</span>
                @endif
            </td>
            <td>
                <a href="{{ route('admin.bookings.show', $booking) }}" class="btn btn-info btn-sm">Detail</a>
                <a href="{{ route('admin.bookings.edit', $booking) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection 
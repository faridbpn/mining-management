@extends('layouts.app')
@section('content')
<h1 class="mb-4">Pemesanan Saya</h1>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Kendaraan</th>
            <th>Driver</th>
            <th>Tujuan</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $booking)
        <tr>
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
                <a href="{{ route('employee.bookings.show', $booking) }}" class="btn btn-info btn-sm">Detail</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection 
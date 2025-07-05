@extends('layouts.app')
@section('content')
<h1 class="mb-4">Dashboard Pegawai</h1>
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-bg-primary mb-3">
            <div class="card-body">
                <h5>Total Pemesanan</h5>
                <h2>{{ $totalBookings }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-bg-success mb-3">
            <div class="card-body">
                <h5>Pemesanan Disetujui</h5>
                <h2>{{ $approvedBookings }}</h2>
            </div>
        </div>
    </div>
</div>
<div class="card mb-4">
    <div class="card-body">
        <h5>Pemesanan Terbaru</h5>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Kendaraan</th>
                    <th>Driver</th>
                    <th>Tujuan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($myBookings as $booking)
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection 
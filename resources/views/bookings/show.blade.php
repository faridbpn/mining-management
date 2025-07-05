@extends('layouts.app')
@section('content')
<h1 class="mb-4">Detail Pemesanan</h1>
<div class="card mb-4">
    <div class="card-body">
        <h5>Informasi Pemesanan</h5>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Pegawai:</strong> {{ $booking->user->name ?? '-' }}</p>
                <p><strong>Kendaraan:</strong> {{ $booking->vehicle->name ?? '-' }}</p>
                <p><strong>Driver:</strong> {{ $booking->driver->name ?? '-' }}</p>
                <p><strong>Lokasi:</strong> {{ $booking->location->name ?? '-' }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Tujuan:</strong> {{ $booking->destination }}</p>
                <p><strong>Keperluan:</strong> {{ $booking->purpose }}</p>
                <p><strong>Mulai:</strong> {{ $booking->start_time->format('d/m/Y H:i') }}</p>
                <p><strong>Selesai:</strong> {{ $booking->end_time->format('d/m/Y H:i') }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p><strong>Status:</strong> 
                    @if($booking->status == 'pending')
                        <span class="badge bg-warning">Menunggu Persetujuan</span>
                    @elseif($booking->status == 'approved')
                        <span class="badge bg-success">Disetujui</span>
                    @elseif($booking->status == 'rejected')
                        <span class="badge bg-danger">Ditolak</span>
                    @else
                        <span class="badge bg-secondary">{{ $booking->status }}</span>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>

@if($booking->approvals->count() > 0)
<div class="card mb-4">
    <div class="card-body">
        <h5>Status Approval</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Level</th>
                    <th>Approver</th>
                    <th>Status</th>
                    <th>Catatan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($booking->approvals as $approval)
                <tr>
                    <td>Level {{ $approval->level }}</td>
                    <td>{{ $approval->approver->name ?? '-' }}</td>
                    <td>
                        @if($approval->status == 'pending')
                            <span class="badge bg-warning">Menunggu</span>
                        @elseif($approval->status == 'approved')
                            <span class="badge bg-success">Disetujui</span>
                        @elseif($approval->status == 'rejected')
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                    <td>{{ $approval->note ?? '-' }}</td>
                    <td>{{ $approval->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@if(Auth::user()->isAdmin())
<div class="mb-3">
    <a href="{{ route('admin.bookings.edit', $booking) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@else
<div class="mb-3">
    <a href="{{ route('employee.bookings.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endif
@endsection 
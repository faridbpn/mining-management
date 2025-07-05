@extends('layouts.app')
@section('content')
<h1 class="mb-4">Detail Persetujuan</h1>
<div class="card mb-4">
    <div class="card-body">
        <h5>Informasi Pemesanan</h5>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Pegawai:</strong> {{ $approval->booking->user->name ?? '-' }}</p>
                <p><strong>Kendaraan:</strong> {{ $approval->booking->vehicle->name ?? '-' }}</p>
                <p><strong>Driver:</strong> {{ $approval->booking->driver->name ?? '-' }}</p>
                <p><strong>Lokasi:</strong> {{ $approval->booking->location->name ?? '-' }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Tujuan:</strong> {{ $approval->booking->destination }}</p>
                <p><strong>Keperluan:</strong> {{ $approval->booking->purpose }}</p>
                <p><strong>Mulai:</strong> {{ $approval->booking->start_time->format('d/m/Y H:i') }}</p>
                <p><strong>Selesai:</strong> {{ $approval->booking->end_time->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>
@if($approval->status == 'pending')
<div class="card">
    <div class="card-body">
        <h5>Proses Persetujuan</h5>
        <form action="{{ route('approver.approvals.update', $approval) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label>Catatan (opsional)</label>
                <textarea name="note" class="form-control"></textarea>
            </div>
            <button type="submit" name="status" value="approved" class="btn btn-success">Setujui</button>
            <button type="submit" name="status" value="rejected" class="btn btn-danger">Tolak</button>
        </form>
    </div>
</div>
@else
<div class="alert alert-info">
    Status: <strong>{{ $approval->status }}</strong>
    @if($approval->note)
        <br>Catatan: {{ $approval->note }}
    @endif
</div>
@endif
@endsection 
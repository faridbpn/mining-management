View [auth.login] not found.@extends('layouts.app')
@section('content')
<h1 class="mb-4">Dashboard Approver</h1>
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card text-bg-warning mb-3"><div class="card-body"><h5>Permintaan Perlu Disetujui</h5><h2>{{ $pendingApprovals }}</h2></div></div>
    </div>
</div>
<div class="card mb-4">
    <div class="card-body">
        <h5>Notifikasi Pemesanan Terbaru</h5>
        <ul class="list-group">
            @foreach($latestBookings as $approval)
                <li class="list-group-item">
                    Pemesanan oleh: <b>{{ $approval->booking->user->name ?? '-' }}</b> | Tujuan: {{ $approval->booking->destination ?? '-' }}
                    <a href="{{ route('approver.approvals.show', $approval) }}" class="btn btn-sm btn-primary float-end">Lihat Detail</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection 
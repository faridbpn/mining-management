@extends('layouts.app')
@section('content')
<h1 class="mb-4">Daftar Persetujuan</h1>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nama Pegawai</th>
            <th>Tujuan</th>
            <th>Jenis Kendaraan</th>
            <th>Tanggal</th>
            <th>Level</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($approvals as $approval)
        <tr>
            <td>{{ $approval->booking->user->name ?? '-' }}</td>
            <td>{{ $approval->booking->destination ?? '-' }}</td>
            <td>{{ $approval->booking->vehicle->name ?? '-' }}</td>
            <td>{{ $approval->booking->start_time->format('d/m/Y H:i') ?? '-' }}</td>
            <td>Level {{ $approval->level }}</td>
            <td>
                @if($approval->status == 'pending')
                    <span class="badge bg-warning">Menunggu</span>
                @elseif($approval->status == 'approved')
                    <span class="badge bg-success">Disetujui</span>
                @elseif($approval->status == 'rejected')
                    <span class="badge bg-danger">Ditolak</span>
                @endif
            </td>
            <td>
                <a href="{{ route('approver.approvals.show', $approval) }}" class="btn btn-info btn-sm">Lihat Detail</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection 
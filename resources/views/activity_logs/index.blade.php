@extends('layouts.app')
@section('content')
<h1 class="mb-4">Log Aktivitas</h1>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Waktu</th>
            <th>User</th>
            <th>Aksi</th>
            <th>Deskripsi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $log)
        <tr>
            <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
            <td>{{ $log->user->name ?? 'System' }}</td>
            <td>{{ $log->action }}</td>
            <td>{{ $log->description }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $logs->links() }}
@endsection 
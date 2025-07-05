@extends('layouts.app')
@section('content')
<h1 class="mb-4 text-2xl font-bold">Laporan</h1>
<div class="overflow-x-auto">
<table class="table table-bordered table-striped min-w-full bg-white rounded shadow">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-2">No</th>
            <th class="px-4 py-2">Judul</th>
            <th class="px-4 py-2">Tanggal</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reports as $report)
        <tr>
            <td class="px-4 py-2">{{ $loop->iteration }}</td>
            <td class="px-4 py-2">{{ $report->title }}</td>
            <td class="px-4 py-2">{{ $report->created_at->format('d/m/Y') }}</td>
            <td class="px-4 py-2 flex gap-1">
                <a href="{{ route('admin.reports.export', $report) }}" class="btn btn-info btn-sm bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded">Export</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection 
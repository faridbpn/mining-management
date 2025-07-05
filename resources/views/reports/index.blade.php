@extends('layouts.app')
@section('content')
<h1 class="mb-4">Laporan Pemesanan Kendaraan</h1>
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row">
            <div class="col-md-3">
                <label>Tanggal Mulai</label>
                <input type="date" name="start" value="{{ request('start') }}" class="form-control">
            </div>
            <div class="col-md-3">
                <label>Tanggal Akhir</label>
                <input type="date" name="end" value="{{ request('end') }}" class="form-control">
            </div>
            <div class="col-md-3">
                <label>Lokasi</label>
                <select name="location_id" class="form-control">
                    <option value="">Semua Lokasi</option>
                    @foreach(\App\Models\Location::all() as $loc)
                        <option value="{{ $loc->id }}" {{ request('location_id') == $loc->id ? 'selected' : '' }}>{{ $loc->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Jenis Kendaraan</label>
                <select name="vehicle_type" class="form-control">
                    <option value="">Semua Jenis</option>
                    <option value="passenger" {{ request('vehicle_type') == 'passenger' ? 'selected' : '' }}>Angkutan Orang</option>
                    <option value="goods" {{ request('vehicle_type') == 'goods' ? 'selected' : '' }}>Angkutan Barang</option>
                </select>
            </div>
            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.reports.export') }}?{{ http_build_query(request()->all()) }}" class="btn btn-success">Export Excel</a>
            </div>
        </form>
    </div>
</div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Vehicle</th>
            <th>Driver</th>
            <th>Location</th>
            <th>Purpose</th>
            <th>Destination</th>
            <th>Start</th>
            <th>End</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $booking)
        <tr>
            <td>{{ $booking->id }}</td>
            <td>{{ $booking->user->name ?? '' }}</td>
            <td>{{ $booking->vehicle->name ?? '' }}</td>
            <td>{{ $booking->driver->name ?? '' }}</td>
            <td>{{ $booking->location->name ?? '' }}</td>
            <td>{{ $booking->purpose }}</td>
            <td>{{ $booking->destination }}</td>
            <td>{{ $booking->start_time }}</td>
            <td>{{ $booking->end_time }}</td>
            <td>{{ $booking->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $bookings->links() }}
@endsection 
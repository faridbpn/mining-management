@extends('layouts.app')
@section('content')
<h1 class="mb-4">Tambah Pemesanan Kendaraan</h1>
<form action="{{ route('admin.bookings.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label>Pegawai Pemesan</label>
                <select name="user_id" class="form-control" required>
                    @foreach(\App\Models\User::all() as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Jenis Kendaraan</label>
                <select name="vehicle_id" class="form-control" required>
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}">{{ $vehicle->name }} ({{ $vehicle->type }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Driver</label>
                <select name="driver_id" class="form-control" required>
                    @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label>Lokasi</label>
                <select name="location_id" class="form-control" required>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Tujuan</label>
                <input type="text" name="destination" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Keperluan</label>
                <textarea name="purpose" class="form-control" required></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label>Tanggal & Jam Mulai</label>
                <input type="datetime-local" name="start_time" class="form-control" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label>Tanggal & Jam Selesai</label>
                <input type="datetime-local" name="end_time" class="form-control" required>
            </div>
        </div>
    </div>
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection 
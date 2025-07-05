@extends('layouts.app')
@section('content')
<h1 class="mb-4">Tambah Kendaraan</h1>
<form action="{{ route('vehicles.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nama Kendaraan</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Jenis</label>
        <select name="type" class="form-control" required>
            <option value="passenger">Angkutan Orang</option>
            <option value="goods">Angkutan Barang</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Kepemilikan</label>
        <select name="ownership" class="form-control" required>
            <option value="owned">Milik Sendiri</option>
            <option value="rented">Sewa</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Plat Nomor</label>
        <input type="text" name="plate_number" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Lokasi</label>
        <select name="location_id" class="form-control" required>
            @foreach($locations as $loc)
                <option value="{{ $loc->id }}">{{ $loc->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Kapasitas BBM (liter)</label>
        <input type="number" name="fuel_capacity" class="form-control">
    </div>
    <div class="mb-3">
        <label>Interval Service (km)</label>
        <input type="number" name="service_interval_km" class="form-control">
    </div>
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection 
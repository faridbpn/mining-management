@extends('layouts.app')
@section('content')
<h1 class="mb-4 text-2xl font-bold">Tambah Pemesanan Kendaraan</h1>
<form action="{{ route('admin.bookings.store') }}" method="POST" class="bg-white p-6 rounded shadow-md max-w-2xl mx-auto">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block mb-1 font-semibold">Pegawai Pemesan</label>
            <select name="user_id" class="form-control w-full border rounded p-2" required>
                @foreach(\App\Models\User::all() as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block mb-1 font-semibold">Jenis Kendaraan</label>
            <select name="vehicle_id" class="form-control w-full border rounded p-2" required>
                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}">{{ $vehicle->name }} ({{ $vehicle->type }})</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block mb-1 font-semibold">Driver</label>
            <select name="driver_id" class="form-control w-full border rounded p-2" required>
                @foreach($drivers as $driver)
                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block mb-1 font-semibold">Lokasi</label>
            <select name="location_id" class="form-control w-full border rounded p-2" required>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="md:col-span-2">
            <label class="block mb-1 font-semibold">Tujuan</label>
            <input type="text" name="destination" class="form-control w-full border rounded p-2" required>
        </div>
        <div class="md:col-span-2">
            <label class="block mb-1 font-semibold">Keperluan</label>
            <textarea name="purpose" class="form-control w-full border rounded p-2" required></textarea>
        </div>
        <div>
            <label class="block mb-1 font-semibold">Tanggal & Jam Mulai</label>
            <input type="datetime-local" name="start_time" class="form-control w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block mb-1 font-semibold">Tanggal & Jam Selesai</label>
            <input type="datetime-local" name="end_time" class="form-control w-full border rounded p-2" required>
        </div>
    </div>
    <div class="mt-6 flex gap-2">
        <button class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">Batal</a>
    </div>
</form>
@endsection
@section('scripts')
<script>
    // Optional: custom JS
</script>
@endsection 
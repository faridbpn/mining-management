@extends('layouts.app')
@section('content')
<div class="flex items-center justify-center min-h-[80vh] bg-gray-100">
    <div class="w-full max-w-lg bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-2xl font-bold mb-6 text-blue-700">Edit Kendaraan</h2>
        <form action="{{ route('admin.vehicles.update', $vehicle) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium mb-1">Nama Kendaraan</label>
                <input type="text" name="name" class="form-input w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror" required value="{{ old('name', $vehicle->name) }}">
                @error('name')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Tipe</label>
                <select name="type" class="form-input w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('type') border-red-500 @enderror" required>
                    <option value="">Pilih Tipe</option>
                    <option value="passenger" {{ old('type', $vehicle->type) == 'passenger' ? 'selected' : '' }}>Penumpang</option>
                    <option value="goods" {{ old('type', $vehicle->type) == 'goods' ? 'selected' : '' }}>Barang</option>
                </select>
                @error('type')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Kepemilikan</label>
                <select name="ownership" class="form-input w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('ownership') border-red-500 @enderror" required>
                    <option value="">Pilih Kepemilikan</option>
                    <option value="owned" {{ old('ownership', $vehicle->ownership) == 'owned' ? 'selected' : '' }}>Milik Perusahaan</option>
                    <option value="rented" {{ old('ownership', $vehicle->ownership) == 'rented' ? 'selected' : '' }}>Sewa</option>
                </select>
                @error('ownership')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Lokasi</label>
                <select name="location_id" class="form-input w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('location_id') border-red-500 @enderror" required>
                    <option value="">Pilih Lokasi</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}" {{ old('location_id', $vehicle->location_id) == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                    @endforeach
                </select>
                @error('location_id')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex gap-2 mt-6">
                <button class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold py-2 rounded-lg transition">Update</button>
                <a href="{{ route('admin.vehicles.index') }}" class="w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 rounded-lg text-center transition">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection 
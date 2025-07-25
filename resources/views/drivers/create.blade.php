@extends('layouts.app')
@section('content')
<div class="flex items-center justify-center min-h-[80vh] bg-gray-100">
    <div class="w-full max-w-lg bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-2xl font-bold mb-6 text-blue-700">Tambah Driver</h2>
        <form action="{{ route('admin.drivers.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Nama Driver</label>
                <input type="text" name="name" class="form-input w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror" required value="{{ old('name') }}">
                @error('name')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Telepon</label>
                <input type="text" name="phone" class="form-input w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('phone') border-red-500 @enderror" required value="{{ old('phone') }}">
                @error('phone')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Lokasi</label>
                <select name="location_id" class="form-input w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('location_id') border-red-500 @enderror" required>
                    <option value="">Pilih Lokasi</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>
                @error('location_id')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex gap-2 mt-6">
                <button class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold py-2 rounded-lg transition">Simpan</button>
                <a href="{{ route('admin.drivers.index') }}" class="w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 rounded-lg text-center transition">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection 
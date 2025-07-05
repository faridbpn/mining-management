@extends('layouts.app')
@section('content')
<h1 class="mb-4">Tambah Driver</h1>
<form action="{{ route('admin.drivers.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nama Driver</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Nomor Telepon</label>
        <input type="text" name="phone" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Lokasi</label>
        <select name="location_id" class="form-control" required>
            @foreach($locations as $loc)
                <option value="{{ $loc->id }}">{{ $loc->name }}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.drivers.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection 
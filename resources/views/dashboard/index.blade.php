@extends('layouts.app')
@section('content')
<h1 class="mb-4">Dashboard Monitoring</h1>
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-bg-primary mb-3"><div class="card-body"><h5>Total Pemesanan</h5><h2>{{ $totalBookings }}</h2></div></div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-success mb-3"><div class="card-body"><h5>Total Kendaraan</h5><h2>{{ $totalVehicles }}</h2></div></div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-warning mb-3"><div class="card-body"><h5>Total Driver</h5><h2>{{ $totalDrivers }}</h2></div></div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-info mb-3"><div class="card-body"><h5>Total Konsumsi BBM</h5><h2>{{ $totalFuel }} L</h2></div></div>
    </div>
</div>
<div class="card mb-4">
    <div class="card-body">
        <h5>Grafik Pemesanan Kendaraan per Bulan</h5>
        <canvas id="bookingChart"></canvas>
    </div>
</div>
@endsection
@section('scripts')
<script>
const ctx = document.getElementById('bookingChart').getContext('2d');
const chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_keys($bookingsPerMonth->toArray())) !!},
        datasets: [{
            label: 'Jumlah Pemesanan',
            data: {!! json_encode(array_values($bookingsPerMonth->toArray())) !!},
            backgroundColor: 'rgba(54, 162, 235, 0.7)'
        }]
    },
    options: {responsive: true}
});
</script>
@endsection 
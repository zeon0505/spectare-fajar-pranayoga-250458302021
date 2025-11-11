@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <h2 class="mb-4">🎬 Dashboard Admin</h2>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Film</h5>
                    <p class="display-6 fw-bold text-primary">12</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Studio</h5>
                    <p class="display-6 fw-bold text-success">5</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Tiket Terjual</h5>
                    <p class="display-6 fw-bold text-warning">324</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Pendapatan</h5>
                    <p class="display-6 fw-bold text-danger">Rp 12.340.000</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h4>Statistik Pemesanan Bulanan</h4>
        <div class="card p-4 shadow-sm">
            <canvas id="chartBookings"></canvas>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chartBookings');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
        datasets: [{
            label: 'Jumlah Pemesanan',
            data: [30, 45, 25, 60, 75, 90, 80],
            borderColor: '#4f46e5',
            backgroundColor: 'rgba(79,70,229,0.2)',
            tension: 0.4,
            fill: true,
        }]
    },
});
</script>
@endpush
@endsection

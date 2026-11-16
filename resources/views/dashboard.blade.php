@extends('layouts.app')

@section('title', 'Dashboard Overview')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-2 border-bottom">
    <div>
        <h3 class="fw-bold text-dark mb-1">Ringkasan Operasional</h3>
        <p class="text-muted mb-0 small">Pantau performa layanan dan aktivitas transaksi kasir harian.</p>
    </div>
    <div class="mt-3 mt-md-0">
        <span class="badge bg-white text-secondary border px-3 py-2 fw-medium shadow-sm">
            <i class="fa-regular fa-calendar-check me-2 text-primary"></i>{{ date('d M Y') }}
        </span>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center" role="alert">
        <i class="fa-solid fa-circle-check text-success fa-lg me-3"></i>
        <div>{{ session('success') }}</div>
    </div>
@endif

<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card bg-white p-4">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <span class="text-muted fw-semibold small text-uppercase" style="letter-spacing: 0.05em;">Layanan Jasa</span>
                    <h2 class="fw-extrabold text-dark mt-2 mb-0" style="font-weight: 800;">{{ $totalServices }}</h2>
                </div>
                <div class="rounded-3 p-3" style="background-color: #eff6ff; color: #2563eb;">
                    <i class="fa-solid fa-wrench fa-lg"></i>
                </div>
            </div>
            <div class="mt-3 pt-3 border-top d-flex align-items-center text-muted small">
                <i class="fa-solid fa-circle-info me-2 text-primary"></i> Data opsi jasa aktif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-white p-4">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <span class="text-muted fw-semibold small text-uppercase" style="letter-spacing: 0.05em;">Transaksi Hari Ini</span>
                    <h2 class="fw-extrabold text-dark mt-2 mb-0" style="font-weight: 800;">{{ $todayTransactions }}</h2>
                </div>
                <div class="rounded-3 p-3" style="background-color: #f0fdf4; color: #16a34a;">
                    <i class="fa-solid fa-receipt fa-lg"></i>
                </div>
            </div>
            <div class="mt-3 pt-3 border-top d-flex align-items-center text-muted small">
                <i class="fa-solid fa-clock-rotate-left me-2 text-success"></i> Terkumpul hari ini
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-white p-4">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <span class="text-muted fw-semibold small text-uppercase" style="letter-spacing: 0.05em;">Omzet Hari Ini</span>
                    <h2 class="fw-extrabold text-dark mt-2 mb-0" style="font-weight: 800;">Rp {{ number_format($todayIncome, 0, ',', '.') }}</h2>
                </div>
                <div class="rounded-3 p-3" style="background-color: #fffbeb; color: #d97706;">
                    <i class="fa-solid fa-wallet fa-lg"></i>
                </div>
            </div>
            <div class="mt-3 pt-3 border-top d-flex align-items-center text-muted small">
                <i class="fa-solid fa-chart-line me-2 text-warning"></i> Total pendapatan bruto
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card bg-white p-4">
    <h6 class="fw-bold text-dark mb-3">Aksi Cepat</h6>
    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('transactions.create') }}" class="btn btn-primary px-4 py-2">
            <i class="fa-solid fa-plus me-2"></i>Input Transaksi Baru
        </a>
        @if(Auth::user()->role === 'admin')
        <a href="{{ route('services.index') }}" class="btn bg-light text-dark border px-4 py-2">
            <i class="fa-solid fa-sliders me-2"></i>Kelola Layanan
        </a>
        <a href="{{ route('reports.index') }}" class="btn bg-light text-dark border px-4 py-2">
            <i class="fa-solid fa-file-invoice-dollar me-2"></i>Rekapitulasi Laba
        </a>
        @endif
    </div>
</div>
@endsection
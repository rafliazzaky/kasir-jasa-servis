@extends('layouts.app')

@section('title', 'Laporan Laba & Transaksi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold">Laporan Rekapitulasi Pendapatan</h3>
        <p class="text-muted mb-0">Ringkasan transaksi jasa servis harian bengkel.</p>
    </div>
    <div class="bg-white p-3 rounded shadow-sm border border-success">
        <span class="text-muted small d-block">Total Accumulated Income:</span>
        <h4 class="fw-bold text-success mb-0">Rp {{ number_format($grandTotal, 0, ',', '.') }}</h4>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <h5 class="fw-bold mb-0"><i class="fa-solid fa-file-invoice-dollar me-2"></i>Rekapitulasi Harian</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-3">Tanggal</th>
                        <th>Jumlah Transaksi Servis</th>
                        <th class="text-end pe-3">Total Pendapatan Harian</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $item)
                    <tr>
                        <td class="ps-3 fw-bold"><i class="fa-regular fa-calendar-check me-2 text-primary"></i>{{ date('d F Y', strtotime($item->date)) }}</td>
                        <td><span class="badge bg-info text-dark fs-6">{{ $item->total_transactions }} Transaksi</span></td>
                        <td class="text-end pe-3 fw-bold text-success fs-6">Rp {{ number_format($item->total_revenue, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 text-muted">Belum ada data transaksi yang tercatat dalam sistem.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
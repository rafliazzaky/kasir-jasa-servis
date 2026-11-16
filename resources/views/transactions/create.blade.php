@extends('layouts.app')

@section('title', 'Transaksi Kasir Baru')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold">Form Input Transaksi Jasa Servis</h3>
    <p class="text-muted">Pilih satu atau beberapa layanan servis yang dilakukan untuk kendaraan pelanggan.</p>
</div>

@if(session('error'))
    <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
@endif

<form action="{{ route('transactions.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0"><i class="fa-solid fa-list me-2"></i>Pilih Jasa Servis</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @forelse($services as $item)
                        <label class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <div>
                                <input class="form-check-input me-2 service-checkbox" type="checkbox" name="service_ids[]" value="{{ $item->id }}" data-price="{{ $item->price }}">
                                <span class="fw-bold fs-6">{{ $item->name }}</span>
                                <small class="text-muted d-block ms-4">{{ $item->description ?? 'Tidak ada deskripsi' }}</small>
                            </div>
                            <span class="badge bg-primary rounded-pill fs-6">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                        </label>
                        @empty
                        <div class="text-center py-4 text-muted">Belum ada data jasa servis terdaftar. Sila minta Admin menambahkan data jasa terlebih dahulu.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-dark text-white py-3">
                    <h5 class="fw-bold mb-0"><i class="fa-solid fa-calculator me-2"></i>Ringkasan Biaya</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Kasir Bertugas:</span>
                        <span class="fw-bold">{{ Auth::user()->name }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0">Total Biaya:</h5>
                        <h3 class="fw-bold text-success mb-0" id="totalDisplay">Rp 0</h3>
                    </div>
                    <button type="submit" class="btn btn-success btn-lg w-100 fw-bold">
                        <i class="fa-solid fa-print me-1"></i> Simpan Transaksi
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.service-checkbox');
        const totalDisplay = document.getElementById('totalDisplay');

        checkboxes.forEach(cb => {
            cb.addEventListener('change', calculateTotal);
        });

        function calculateTotal() {
            let total = 0;
            checkboxes.forEach(cb => {
                if (cb.checked) {
                    total += parseFloat(cb.getAttribute('data-price'));
                }
            });
            totalDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
        }
    });
</script>
@endsection
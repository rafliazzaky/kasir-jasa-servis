@extends('layouts.app')

@section('title', 'Kelola Jasa Servis')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Kelola Layanan Jasa Servis</h3>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">
        <i class="fa-solid fa-plus me-1"></i> Tambah Jasa Servis
    </button>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-3">No</th>
                        <th>Nama Layanan Jasa</th>
                        <th>Biaya Servis</th>
                        <th>Deskripsi</th>
                        <th class="text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $index => $item)
                    <tr>
                        <td class="ps-3">{{ $index + 1 }}</td>
                        <td class="fw-bold">{{ $item->name }}</td>
                        <td class="text-success fw-bold">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>{{ $item->description ?? '-' }}</td>
                        <td class="text-end pe-3">
                            <!-- Tombol Edit -->
                            <button class="btn btn-sm btn-outline-warning me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <!-- Tombol Hapus -->
                            <form action="{{ route('services.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus jasa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit Jasa -->
                    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('services.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold">Edit Jasa Servis</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Layanan</label>
                                            <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Biaya (Rp)</label>
                                            <input type="number" name="price" class="form-control" value="{{ $item->price }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Deskripsi</label>
                                            <textarea name="description" class="form-control" rows="2">{{ $item->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Belum ada data jasa servis. Klik tombol tambah untuk memasukkan data.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Jasa -->
<div class="modal fade" id="addServiceModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('services.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Jasa Servis Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Layanan Jasa</label>
                        <input type="text" name="name" class="form-control" placeholder="Contoh: Servis Rutin Karburator" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Biaya (Rp)</label>
                        <input type="number" name="price" class="form-control" placeholder="50000" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi (Opsional)</label>
                        <textarea name="description" class="form-control" rows="2" placeholder="Pembersihan karburator & setel angin"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Jasa</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
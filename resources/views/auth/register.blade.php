<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Kasir - Kasir Bengkel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100 py-4">
    <div class="card p-4 shadow-sm" style="width: 400px;">
        <h4 class="text-center mb-1 fw-bold">Registrasi Akun Kasir</h4>
        <p class="text-center text-muted small mb-3">Buat akun untuk petugas kasir bengkel</p>

        @if($errors->any())
            <div class="alert alert-danger p-2 small">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <div class="mb-2">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-2">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="mb-2">
                <label class="form-label">Password (Min. 8 Karakter)</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-success w-100 fw-bold">Daftar Sebagai Kasir</button>
        </form>
        <p class="text-center mt-3 text-muted small">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
    </div>
</body>
</html>
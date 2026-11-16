<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kasir Bengkel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">
    <div class="card p-4 shadow-sm" style="width: 380px;">
        <h4 class="text-center mb-3 fw-bold">Login Bengkel</h4>
        
        @if(session('success'))
            <div class="alert alert-success p-2 small">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger p-2 small">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 fw-bold">Masuk</button>
        </form>
        <p class="text-center mt-3 text-muted small">Belum ada akun? <a href="{{ route('register') }}">Registrasi</a></p>
    </div>
</body>
</html>
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Models\Service;
use App\Models\Transaction;

// Halaman Utama -> Alihkan ke Login
Route::get('/', function () {
    return redirect()->route('login');
});

// Route Autentikasi (Guest / Tamu)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route Terproteksi (Harus Login)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
    $totalServices = Service::count();
    $todayTransactions = Transaction::whereDate('created_at', date('Y-m-d'))->count();
    $todayIncome = Transaction::whereDate('created_at', date('Y-m-d'))->sum('total_price');

    return view('dashboard', compact('totalServices', 'todayTransactions', 'todayIncome'));
})->name('dashboard');
    // Dashboard (Bisa diakses Admin & Kasir)
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');

    Route::middleware(['admin'])->group(function () {
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');

    // Route Laporan
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    });
});
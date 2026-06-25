<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;


// Perpustakaan Controller
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriBukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\LaporanController;




// Halaman pertama langsung diarahkan ke dashboard
Route::get('/', fn () => redirect('/dashboard'));

// Semua route di bawah ini wajib login (lihat middleware 'auth')
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::patch('/transactions/{transaction}/status', [TransactionController::class, 'updateStatus'])->name('transactions.updateStatus');
    
    /*
    |--------------------------------------------------------------------------
    | Master Perpustakaan
    |--------------------------------------------------------------------------
    */

    Route::resource('anggota', AnggotaController::class);
    Route::resource('buku', BukuController::class);
    Route::resource('kategori-buku', KategoriBukuController::class);
    Route::resource('denda', DendaController::class);
    Route::resource('peminjaman', PeminjamanController::class);
    Route::patch('peminjaman/{peminjaman}/kembali', [PeminjamanController::class,'kembali'])->name('peminjaman.kembali');
    /*
    Route khusus admin: tambah / edit / hapus master data.
    Contoh penggantian nama sesuai kebutuhan bisnis:
    - Perpustakaan : Category = Jenis Buku, Item = Buku
    - Apotek       : Category = Jenis Obat, Item = Obat
    - Toko         : Category = Kategori Produk, Item = Produk
    */
    Route::prefix('laporan')->group(function(){
    Route::get(
        '/anggota',
        [LaporanController::class,'anggota']
    )
    ->name('laporan.anggota');
    Route::get(
        '/buku',
        [LaporanController::class,'buku']
    )
    ->name('laporan.buku');
    Route::get(
        '/peminjaman',
        [LaporanController::class,'peminjaman']
    )
    ->name('laporan.peminjaman');
    });

    Route::middleware('admin')->group(function () {
    Route::resource(
        'users',
        UserController::class
        );
    });
});

// Route bawaan Laravel Breeze: login, register, logout, forgot password
require __DIR__.'/auth.php';

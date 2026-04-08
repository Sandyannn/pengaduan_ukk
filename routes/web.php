<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporan;
use App\Http\Controllers\Admin\AspirasiController;
use App\Http\Controllers\Siswa\InputAspirasiController;
use App\Http\Controllers\Siswa\LaporanController as PublicLaporan;
use Illuminate\Support\Facades\Route;

use App\Models\InputAspirasi;

Route::get('/', function () {
    $laporans = InputAspirasi::with('user')
                ->where('status', '!=', 'menunggu')
                ->latest()
                ->take(6) 
                ->get();

    return view('welcome', compact('laporans'));
});;

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('/kategori', KategoriController::class);
        Route::get('/laporan', [AdminLaporan::class, 'index'])->name('laporan.index');
        Route::post('/aspirasi', [AspirasiController::class, 'store'])->name('aspirasi.store');
        Route::patch('/aspirasi/{id}/proses', [AspirasiController::class, 'updateStatus'])->name('aspirasi.proses');
        Route::get('/laporan/{id}', [AdminLaporan::class, 'show'])->name('laporan.show');

    });

    Route::middleware(['role:siswa'])->name('siswa.')->group(function () {
        Route::get('/dashboard', [InputAspirasiController::class, 'index'])->name('dashboard');

        Route::post('/aspirasi', [InputAspirasiController::class, 'store'])->name('aspirasi.store');

        Route::get('/laporan', [PublicLaporan::class, 'index'])->name('laporan.index');
        Route::get('/laporan/{id}', [PublicLaporan::class, 'show'])->name('laporan.show');
    });
});

require __DIR__ . '/auth.php';

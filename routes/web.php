<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SatelliteController;
use App\Http\Controllers\GroundStationController;
use App\Http\Controllers\Auth\AuthController; // Wajib dipanggil agar tidak error

// Redirect awal ke login
Route::redirect('/', '/login');

// --- PENGGANTI Auth::routes(); ---
// Rute ini memanggil AuthController kustom milikmu (menampilkan tema galaksi)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Rute logout (Hanya bisa diakses jika sudah login)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// --- FITUR UTAMA APLIKASI ---
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/statistics', [DashboardController::class, 'statistics'])->name('statistics');

    Route::get('/satellites/live-tracking', [SatelliteController::class, 'liveTracking'])->name('satellites.live');
    
    Route::resource('satellites', SatelliteController::class);
    Route::post('/satellites/{satellite}/sync-tle', [SatelliteController::class, 'syncSingleTLE'])->name('satellites.sync-tle');
    
    Route::resource('ground-stations', GroundStationController::class);
});

// Redirect jika mengakses /home
Route::redirect('/home', '/dashboard');
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterControllers;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\Dashboard\UserDashboardController;
use App\Http\Controllers\Dashboard\OperatorDashboardController;
use App\Http\Controllers\Dashboard\DokterDashboardController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\DokterPerawatanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Auth routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'actionLogin'])->name('login.action');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'actionRegister'])->name('register.action');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password reset routes
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', action: [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
});

// Dashboard routes berdasarkan role
Route::middleware('auth')->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/operator/dashboard', [OperatorDashboardController::class, 'index'])->middleware('is_operator')->name('operator.dashboard');
    Route::get('/dokter/dashboard', [DokterDashboardController::class, 'index'])->middleware('is_dokter')->name('dokter.dashboard');
});

// Route untuk operator
Route::middleware(['auth', 'is_operator'])->prefix('operator')->name('operator.')->group(function () {
    Route::resource('dktr', DokterControllers::class);
    Route::resource('ruangan', RuanganController::class);
    Route::resource('pasiens', PasienController::class);
    Route::get('kunjungan', [OperatorController::class, 'daftarKunjungan'])->name('kunjungan');
    Route::post('kunjungan/set-dokter/{id}', [OperatorController::class, 'setDokter'])->name('set-dokter');
});

// Route untuk dokter
Route::middleware(['auth', 'is_dokter'])->prefix('dokter')->name('dokter.')->group(function () {
    Route::get('perawatan/create/{pasienId}', [DokterPerawatanController::class, 'create'])->name('perawatan.create');
    Route::post('perawatan/store', [DokterPerawatanController::class, 'store'])->name('perawatan.store');
    Route::get('perawatan/list', [DokterPerawatanController::class, 'list'])->name('perawatan.list');
});

// Route untuk user biasa
Route::middleware(['auth'])->group(function () {
    Route::resource('kunjungan', KunjunganController::class);
    Route::post('kunjungan/{id}/cancel', [KunjunganController::class, 'cancel'])->name('kunjungan.cancel');
    Route::resource('pasiens', PasienController::class);
});

Route::get('dktr/landing', [DokterControllers::class, 'landing'])->name('dktr.landing');
<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterControllers;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\PasienController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::get('/profile', [AuthController::class, 'edit'])->middleware('auth')->name('profile.edit');
Route::patch('/profile', [AuthController::class, 'updateProfile'])->middleware('auth')->name('profile.update');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'actionLogin'])->name('login.action');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'actionRegister'])->name('register.action');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Jika ingin halaman landing khusus
Route::get('/dktr/landing', [DokterControllers::class, 'landing'])->name('dktr.landing');

// Resource Dokter
Route::resource('dktr', DokterControllers::class);


Route::resource('ruangan', RuanganController::class);


Route::resource('pasiens', PasienController::class);

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\GaleriUsahaController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminManagementController;
use App\Http\Controllers\EventController;

// Halaman welcome
Route::get('/', function () {
    return view('welcome');
});

// ===========================
// AUTH ADMIN
// ===========================
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// ===========================
// ROUTE KHUSUS ADMIN
// ===========================
Route::middleware('auth:admin')->group(function () {

    // Admin Management
    Route::get('/admin/manage', [AdminManagementController::class, 'index'])->name('admin.manage');
    Route::get('/admin/manage/create', [AdminManagementController::class, 'create'])->name('admin.manage.create');
    Route::post('/admin/manage/store', [AdminManagementController::class, 'store'])->name('admin.manage.store');

    // CRUD Resource
    Route::resource('galeri', GaleriUsahaController::class);
    Route::resource('loker', LokerController::class);
    Route::resource('alumni', AlumniController::class);       // ADMIN CRUD ALUMNI
    Route::resource('perusahaan', PerusahaanController::class);
    Route::resource('event', EventController::class);
});

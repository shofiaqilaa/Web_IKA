<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumniController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rute API alumni
Route::get('/alumni', [AlumniController::class, 'index']); // ambil semua data
Route::post('/alumni', [AlumniController::class, 'store']); // tambah data

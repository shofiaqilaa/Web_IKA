<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AlumniAuthController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\EventController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rute API alumni
Route::get('/alumni', [AlumniController::class, 'index']); // ambil semua data
Route::post('/alumni', [AlumniController::class, 'store']); // tambah data
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [AlumniAuthController::class, 'login']);
Route::get('/loker', [LokerController::class, 'apiIndex']);
Route::get('/events', [EventController::class, 'apiIndex']);
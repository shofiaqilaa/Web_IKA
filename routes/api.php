<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AlumniAuthController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GaleriController; // ← tambahkan controller galeri



/*
|--------------------------------------------------------------------------
| Auth Sanctum
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/*
|--------------------------------------------------------------------------
| Alumni
|--------------------------------------------------------------------------
*/
Route::get('/alumni', [AlumniController::class, 'index']);        // ambil semua data
Route::post('/alumni', [AlumniController::class, 'storeApi']);    // tambah data
Route::post('/login', [AlumniAuthController::class, 'login']);    // login alumni


/*
|--------------------------------------------------------------------------
| Loker
|--------------------------------------------------------------------------
*/
Route::get('/loker', [LokerController::class, 'apiIndex']);       // list loker


/*
|--------------------------------------------------------------------------
| Event
|--------------------------------------------------------------------------
*/
Route::get('/events', [EventController::class, 'apiIndex']);      // list event


/*
|--------------------------------------------------------------------------
| Galeri Usaha (BARU)
|--------------------------------------------------------------------------
| CRUD:
| GET    /galeri          → index (ambil semua data)
| POST   /galeri          → store (tambah galeri)
| GET    /galeri/{id}     → show (detail)
| PUT    /galeri/{id}     → update
| DELETE /galeri/{id}     → destroy
|--------------------------------------------------------------------------
*/

Route::get('/galeri', [GaleriController::class, 'apiIndex']);
Route::post('/galeri', [GaleriController::class, 'apiStore']);
Route::get('/galeri/{id}', [GaleriController::class, 'apiShow']);
Route::post('/galeri/{id}', [GaleriController::class, 'apiUpdate']);
Route::delete('/galeri/{id}', [GaleriController::class, 'apiDelete']);

// Serve gallery images through Laravel so CORS headers are applied
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

Route::get('/files/galeri/{filename}', function ($filename) {
    $path = storage_path('app/public/galeri/' . $filename);
    if (!file_exists($path)) {
        return response()->json(['message' => 'Not Found'], 404);
    }
    return response()->file($path);
});

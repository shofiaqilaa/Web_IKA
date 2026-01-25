<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AlumniAuthController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GaleriController; // ← tambahkan controller galeri
use App\Http\Controllers\AdminController;  // ← tambahkan controller admin



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
Route::post('/login-alumni', [AlumniAuthController::class, 'login']);    // login alumni
Route::post('/register-alumni', [AlumniAuthController::class, 'register']);

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
| Admin
|--------------------------------------------------------------------------
*/
Route::get('/admin', [AdminController::class, 'apiIndex']);       // ambil semua admin
Route::get('/admin/{id}', [AdminController::class, 'apiShow']);   // ambil detail admin


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
Route::put('/galeri/{id}', [GaleriController::class, 'apiUpdate']);
Route::delete('/galeri/{id}', [GaleriController::class, 'apiDelete']);

// Serve gallery images with CORS headers applied for Flutter
Route::get('/image/galeri/{filename}', function ($filename) {
    $path = storage_path('app/public/galeri/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path, [
        'Content-Type' => mime_content_type($path),
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET, OPTIONS',
        'Access-Control-Allow-Headers' => '*',
    ]);
})->name('image.galeri');


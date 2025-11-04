<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\GaleriUsahaController;

Route::resource('galeri', GaleriUsahaController::class);
Route::resource('loker', LokerController::class);
Route::resource('alumni', AlumniController::class);
Route::resource('perusahaan', PerusahaanController::class);
<?php

use App\Http\Controllers\YoutubeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [YoutubeController::class, 'index']);

Route::get('/video/show', [YoutubeController::class, 'index'])->name('video');
Route::post('/video/upload', [YoutubeController::class, 'getVideo'])->name('video.upload');

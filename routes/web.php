<?php

use App\Http\Controllers\VideoController;
use App\Http\Controllers\YoutobeController;
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

Route::get('/', [VideoController::class, 'index']);

Route::get('/video/show', [VideoController::class, 'index'])->name('video');
Route::post('/video/upload', [YoutobeController::class, 'getVideo'])->name('video.upload');
Route::get('/video/{videoName}', [VideoController::class, 'showVideo'])->name('video.show');

Route::get('/test', [VideoController::class, 'VideoYTb'])->name('video');
<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\VideoController;
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

Route::get('/', [YoutubeController::class, 'index'])->name('home');

Route::prefix('/video')->name('video.')->group(function () {
    Route::get('/{video}', VideoController::class)->name('index');
    Route::post('/show', [YoutubeController::class, 'getVideo'])->name('upload');
});

Route::get('language/{locale}', LanguageController::class)->name('lang');

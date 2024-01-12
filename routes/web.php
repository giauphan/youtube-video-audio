<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TermsPolicyController;
use App\Http\Controllers\User\VideoSaveController;
use App\Http\Controllers\Video\DeleteVideoListController;
use App\Http\Controllers\Video\ReportVideoController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\YoutubeController;
use App\Logging\CustomizeApiLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
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
    Route::post('/show', [YoutubeController::class, 'getVideo'])->name('upload')->middleware('throttle:25,1');
    Route::post('report', ReportVideoController::class)->name('report');
});

Route::get('/Terms-and-policy', TermsPolicyController::class)->name('terms.policy');
Route::get('language/{locale}', LanguageController::class)->name('lang');

Route::middleware('auth')->group(function () {
    Route::prefix('user/video')->name('user.video.')->group(function () {
        Route::get('/', VideoSaveController::class)->name('index');
        Route::get('/{video}', VideoController::class)->name('show');
    });
    Route::post('/video-list/delete', DeleteVideoListController::class)->name('videoList.delete');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('user');

Route::get('/test-redis', function () {
    $pingResponse = Redis::ping();
    $selectResponse = Redis::select(1);

    dd($pingResponse, $selectResponse);
});


<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OnAirDataController;
use App\Http\Controllers\PrefectureController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/animes/{season}', [AnimeController::class, 'index'])->name('anime.index');
    Route::get('/anime/{id}', [AnimeController::class, 'show'])->where('id', '[0-9]+')->name('anime.show');
    Route::get('/favorite', [FavoriteController::class, 'index'])->name('favorite.index');
    Route::put('/favorite/{anime_id}', [FavoriteController::class, 'store'])->name('favorite.store');
    Route::delete('/favorite/{anime_id}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');
    Route::get('/user', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user', [UserController::class, 'update'])->name('user.update');
    Route::put('/user/password', [UserController::class, 'updatePassword'])->name('user.updatePassword');
    Route::delete('/user', [UserController::class, 'destroy'])->name('user.destroy');
});

Route::get('/prefectures', [PrefectureController::class, 'getPrefectureData']);
Route::get('/onair/{anime_id}', [OnAirDataController::class, 'getLatestOnAirData']);

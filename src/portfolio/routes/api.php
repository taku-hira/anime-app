<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\FavoriteController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/animes', [AnimeController::class, 'index'])->name('anime.index');
Route::get('/animes/{id}', [AnimeController::class, 'show'])->where('id', '[0-9]+')->name('anime.show');

Route::get('/animes/favorite', [FavoriteController::class, 'index'])->name('favorite.index');
Route::put('/animes/{anime_id}/favorite', [FavoriteController::class, 'store'])->name('favorite.store');
Route::delete('/animes/{anime_id}/favorite', [FavoriteController::class, 'destroy'])->name('favorite.destroy');

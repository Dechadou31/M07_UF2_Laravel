<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\ActorController;


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

Route::get('/films', [FilmController::class, 'getFilmsWithActors']);
Route::delete('/actors/{id}', [ActorController::class, 'destroy']);
Route::get('/actors', [ActorController::class, 'apiActorsWithFilms']);
Route::get('allFilm/{id}', [FilmController::class, 'getFilm']);
Route::get('films/{id}', [FilmController::class, 'singleFilm']);
Route::post('/films', [FilmController::class, 'createFilm2']);
Route::put('/films/{id}', [FilmController::class, 'updateFilm']);

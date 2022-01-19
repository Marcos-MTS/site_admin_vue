<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

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


// Lista as notícia
Route::get('/news', [NewsController::class, 'index']);

// Retorna uma unica notícia
Route::get('/news/{id}', [NewsController::class, 'show']);

// Cria uma nova notícia
Route::post('/news', [NewsController::class, 'store']);

// Atualiza a notícia
Route::put('/news/{id}', [NewsController::class, 'update']);

// Exclui a notícia
Route::delete('/news/{id}', [NewsController::class,'destroy']);
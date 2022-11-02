<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersLevelController;
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

Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout']);


/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */


Route::group(['middleware' => ['jwtAuth']], function () {

    // Lista os perfis de usuários
    Route::get('/users_level', [UsersLevelController::class, 'index']);

    // Retorna um unico perfil de usuário
    Route::get('/users_level/{id}', [UsersLevelController::class, 'show']);

    // Cria um novo perfil de usuário
    Route::post('/users_level', [UsersLevelController::class, 'store']);

    // Atualiza o perfil de usuário
    Route::put('/users_level/{id}', [UsersLevelController::class, 'update']);

    // Exclui o perfil de usuário
    Route::delete('/users_level/{id}', [UsersLevelController::class, 'destroy']);

    // Lista os usuários
    Route::get('/users', [UserController::class, 'index']);

    // Retorna um unico usuário
    Route::get('/users/{id}', [UserController::class, 'show']);

    // Cria um novo usuário
    Route::post('/users', [UserController::class, 'store']);

    // Atualiza o usuário
    Route::put('/users/{id}', [UserController::class, 'update']);

    // Exclui o usuário
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    // Lista as notícia
    Route::get('/news', [NewsController::class, 'index']);

    // Retorna uma unica notícia
    Route::get('/news/{id}', [NewsController::class, 'show']);

    // Cria uma nova notícia
    Route::post('/news', [NewsController::class, 'store']);

    // Atualiza a notícia
    Route::put('/news/{id}', [NewsController::class, 'update']);

    // Exclui a notícia
    Route::delete('/news/{id}', [NewsController::class, 'destroy']);

    // Lista as categorias
    Route::get('/categories', [CategoriesController::class, 'index']);

    // Retorna uma unica categoria
    Route::get('/categories/{id}', [CategoriesController::class, 'show']);

    // Cria uma nova categoria
    Route::post('/categories', [CategoriesController::class, 'store']);

    // Atualiza a categoria
    Route::put('/categories/{id}', [CategoriesController::class, 'update']);

    // Exclui a categoria
    Route::delete('/categories/{id}', [CategoriesController::class, 'destroy']);
});

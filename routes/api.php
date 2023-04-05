<?php

use App\Http\Controllers\API\NewsController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('/login', [UserController::class, 'login']);

Route::middleware(['auth:api'])->group(function () {
    Route::get('/news', [NewsController::class, 'index']);
    Route::post('/news/add', [NewsController::class, 'store']);
    Route::post('/news/{id}', [NewsController::class, 'store']);
    Route::post('/news/{id}/{slug}', [NewsController::class, 'show']);
    Route::delete('/news/{id}', [NewsController::class, 'delete']);
    Route::post('/comment/add', [NewsController::class, 'comment']);
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\ClientAPIController;
use App\Http\Controllers\API\ProductAPIController;
use App\Http\Controllers\API\OrderAPIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('clients')->group(function () {

    Route::get('/', [ClientAPIController::class, 'index']);
    Route::post('/', [ClientAPIController::class, 'store']);
    Route::get('/{id}', [ClientAPIController::class, 'show']);
    Route::put('/{id}', [ClientAPIController::class, 'update']);
    Route::delete('/{id}', [ClientAPIController::class, 'destroy']);

});

Route::prefix('products')->group(function () {

    Route::get('/', [ProductAPIController::class, 'index']);
    Route::post('/', [ProductAPIController::class, 'store']);
    Route::get('/{id}', [ProductAPIController::class, 'show']);
    Route::put('/{id}', [ProductAPIController::class, 'update']);
    Route::delete('/{id}', [ProductAPIController::class, 'destroy']);

});

Route::prefix('orders')->group(function () {

    Route::get('/', [OrderAPIController::class, 'index']);
    Route::post('/', [OrderAPIController::class, 'store']);
    Route::get('/{id}', [OrderAPIController::class, 'show']);
    Route::put('/{id}', [OrderAPIController::class, 'update']);
    Route::delete('/{id}', [OrderAPIController::class, 'destroy']);

});


<?php

use App\Http\Controllers\ClientController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('clients')->group(function () {
    Route::get('/', [ClientController::class, 'index']);
    Route::post('/', [ClientController::class, 'store']);


    Route::post('/exibir-todos', [ClientController::class, 'show_all'])->name('clients.show_all');
    Route::post('/', [ClientController::class, 'consult'])->name('clients.consult');

    Route::get('/{id}', [ClientController::class, 'show']);
    Route::put('/{id}', [ClientController::class, 'update']);
    Route::delete('/{id}', [ClientController::class, 'destroy']);

});


// Route::get('/clients', [ClientController::class, 'index']);
// Route::get('/clients/{client_id}', [ClientController::class, 'read_one'])->where('client_id','[0-9]+');

// Route::post('/addclient', [ClientController::class, 'store']);
// Route::get('/clients/register', [ClientController::class, 'register']);



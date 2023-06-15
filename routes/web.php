<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
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
    Route::post('/exibir-todos', [ClientController::class, 'show_all'])->name('clients.show_all');
    Route::post('/exibir_client', [ClientController::class, 'show']);

    Route::get('/cadastrar', [ClientController::class, 'form_post']);
    Route::post('/', [ClientController::class, 'store'])->name('clients.add');

    Route::get('/atualizar', [ClientController::class, 'selec_put']);
    Route::get('/atualizar/form/', [ClientController::class, 'form_put']);
    Route::put('/{id}', [ClientController::class, 'update']);

    Route::get('/deletar', [ClientController::class, 'selec_del']);
    Route::get('/deletar/mass', [ClientController::class, 'selec_massdel']);
    Route::delete('/deletar/mass', [ClientController::class, 'massdel']);
    Route::get('/deletar/confirma', [ClientController::class, 'confirm_destroy']);
    Route::delete('/{id}', [ClientController::class, 'destroy']);

});

Route::prefix('products')->group(function () {

    Route::get('/', [ProductController::class, 'index']);
    Route::post('/exibir-todos', [ProductController::class, 'show_all'])->name('products.show_all');
    Route::post('/exibir_product', [ProductController::class, 'show'])->name('product.show');

    Route::get('/cadastrar', [ProductController::class, 'form_post']);
    Route::post('/', [ProductController::class, 'store'])->name('products.add');

    Route::get('/atualizar', [ProductController::class, 'selec_put']);
    Route::get('/atualizar/form/', [ProductController::class, 'form_put']);
    Route::put('/{id}', [ProductController::class, 'update']);

    Route::get('/deletar', [ProductController::class, 'selec_del']);
    Route::get('/deletar/mass', [ProductController::class, 'selec_massdel']);
    Route::delete('/deletar/mass', [ProductController::class, 'massdel']);
    Route::get('/deletar/confirma', [ProductController::class, 'confirm_destroy']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);

    Route::get('/promo', [ProductController::class, 'selec_promo']);
    Route::get('/promo/confirma', [ProductController::class, 'confirm_promo']);
    Route::put('/promo/{id}', [ProductController::class, 'update_value']);

});

Route::prefix('orders')->group(function () {

    Route::get('/', [OrderController::class, 'index']);
    Route::post('/exibir-todos', [OrderController::class, 'showAll'])->name('products.showAll');
    Route::post('/exibir_order', [OrderController::class, 'show'])->name('product.show');

    Route::get('/cadastrar', [OrderController::class, 'form_post']);
    Route::post('/', [OrderController::class, 'store'])->name('products.add');

    Route::get('/atualizar', [OrderController::class, 'selec_put']);
    Route::get('/atualizar/form/', [OrderController::class, 'form_put']);
    Route::put('/{id}', [OrderController::class, 'update']);

    Route::get('/deletar', [OrderController::class, 'selec_del']);
    Route::get('/deletar/mass', [OrderController::class, 'selec_massdel']);
    Route::delete('/deletar/mass', [OrderController::class, 'massdel']);
    Route::get('/deletar/confirma', [OrderController::class, 'confirm_destroy']);
    Route::delete('/{id}', [OrderController::class, 'destroy']);

});
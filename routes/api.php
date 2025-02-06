<?php

use App\Http\Controllers\CilenteController;
use App\Http\Controllers\ItemVendaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('cliente', [CilenteController::class, 'store']);
Route::get('cliente', [CilenteController::class, 'index']);
Route::get('cliente/find/{id}', [CilenteController::class, 'busca']);
Route::put('cliente/{id}', [CilenteController::class, 'update']);
Route::delete('cliente/find/{id}', [CilenteController::class, 'delete']);


Route::post('produto', [ProdutoController::class, 'store']);
Route::get('produto', [ProdutoController::class, 'index']);
Route::get('produto/find/{id}', [ProdutoController::class, 'busca']);
Route::put('produto/{id}', [ProdutoController::class, 'update']);
Route::delete('produto/find/{id}', [ProdutoController::class, 'delete']);


Route::post('venda', [VendaController::class, 'store']);
Route::get('venda', [VendaController::class, 'index']);
Route::get('venda/find/{id}', [VendaController::class, 'busca']);
Route::put('venda/{id}', [VendaController::class, 'update']);
Route::delete('venda/find/{id}', [VendaController::class, 'delete']);


Route::get('item/venda', [ItemVendaController::class, 'index']);
Route::get('item/venda/find/{id}', [ItemVendaController::class, 'busca']);
Route::put('item/venda/{id}', [ItemVendaController::class, 'update']);
Route::delete('item/venda/find/{id}', [ItemVendaController::class, 'delete']);




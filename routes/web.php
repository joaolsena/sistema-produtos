<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;

Route::get('/', [ProdutoController::class, 'index'])->name('home');

// Rotas API
Route::prefix('api/produtos')->group(function () {
    Route::get('/', [ProdutoController::class, 'listar'])->name('produtos.listar');
    Route::get('/dashboard', [ProdutoController::class, 'dashboard'])->name('produtos.dashboard');
    Route::get('/exportar-excel', [ProdutoController::class, 'exportarExcel'])->name('produtos.exportar.excel');
    Route::get('/exportar-csv', [ProdutoController::class, 'exportarCsv'])->name('produtos.exportar.csv');
    Route::get('/{id}', [ProdutoController::class, 'show'])->name('produtos.show');
    Route::post('/', [ProdutoController::class, 'store'])->name('produtos.store');
    Route::put('/{id}', [ProdutoController::class, 'update'])->name('produtos.update');
    Route::delete('/{id}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');
});
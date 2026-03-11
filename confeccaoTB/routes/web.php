<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\FornecedoresController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProdutosController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::group(['prefix' => 'clientes', 'as' => 'clientes.'], function () {
    Route::get('/', [ClienteController::class, 'index'])->name('index');
    Route::get('/create', [ClienteController::class, 'create'])->name('create');
    Route::post('/', [ClienteController::class, 'store'])->name('store');
    Route::get('/{cliente}/edit', [ClienteController::class, 'edit'])->name('edit');
    Route::put('/{cliente}', [ClienteController::class, 'update'])->name('update');
    Route::delete('/{cliente}', [ClienteController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'pedidos', 'as' => 'pedidos.'], function () {
    Route::get('/', [PedidosController::class, 'index'])->name('index');
    Route::get('/create', [PedidosController::class, 'create'])->name('create');
    Route::post('/', [PedidosController::class, 'store'])->name('store');
    Route::get('/{pedido}/edit', [PedidosController::class, 'edit'])->name('edit');
    Route::put('/{pedido}', [PedidosController::class, 'update'])->name('update');
    Route::delete('/{pedido}', [PedidosController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'fornecedores', 'as' => 'fornecedores.'], function () {
    Route::get('/', [FornecedoresController::class, 'index'])->name('index');
    Route::get('/create', [FornecedoresController::class, 'create'])->name('create');
    Route::post('/', [FornecedoresController::class, 'store'])->name('store');
    Route::get('/{fornecedor}/edit', [FornecedoresController::class, 'edit'])->name('edit');
    Route::put('/{fornecedor}', [FornecedoresController::class, 'update'])->name('update');
    Route::delete('/{fornecedor}', [FornecedoresController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'estoque', 'as' => 'estoque.'], function () {
    Route::get('/', [EstoqueController::class, 'index'])->name('index');
    Route::get('/create', [EstoqueController::class, 'create'])->name('create');
    Route::post('/', [EstoqueController::class, 'store'])->name('store');
    Route::get('/{estoque}/edit', [EstoqueController::class, 'edit'])->name('edit');
    Route::put('/{estoque}', [EstoqueController::class, 'update'])->name('update');
    Route::delete('/{estoque}', [EstoqueController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'produtos', 'as' => 'produtos.'], function () {
    Route::get('/', [ProdutosController::class, 'index'])->name('index');
    Route::get('/create', [ProdutosController::class, 'create'])->name('create');
    Route::post('/', [ProdutosController::class, 'store'])->name('store');
    Route::get('/{produto}/edit', [ProdutosController::class, 'edit'])->name('edit');
    Route::put('/{produto}', [ProdutosController::class, 'update'])->name('update');
    Route::delete('/{produto}', [ProdutosController::class, 'destroy'])->name('destroy');
});
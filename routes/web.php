<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProductoStockController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebhooksController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('inicio');

// Controlador producto
Route::controller(ProductoController::class)->group(function(){
    Route::get('productos', 'index')->name('productos.index');
    Route::get('productos/agregar', 'create')->name('productos.create')->middleware('admin');
    Route::post('productos/guardar', 'store')->name('productos.store')->middleware('admin');
    Route::patch('productos/{producto}/actualizar', 'update')->name('productos.update')->middleware('admin');
    Route::get('productos/administrar/{categoria?}', 'administrar')->name('productos.administrar')->middleware('admin');
    Route::get('productos/{producto}/modificar', 'edit')->name('productos.edit')->middleware('admin');
    Route::get('productos/{producto}', 'destacar')->name('productos.destacar')->middleware('admin');
    Route::get('productos/ver/{categoria}/{producto?}/{cart?}', 'show')->name('productos.show');
    Route::delete('productos/{producto}', 'destroy')->name('productos.destroy')->middleware('admin');
});

// Controlador stock de productos
Route::controller(ProductoStockController::class)->group(function(){
    Route::get('stock/{producto}/agregar', 'create')->name('stock.create')->middleware('admin');
    Route::post('stock/guardar', 'store')->name('stock.store')->middleware('admin');
    Route::get('stock/{producto}', 'show')->name('stock.show')->middleware('admin');
    Route::get('stock/{item}/editar', 'edit')->name('stock.edit')->middleware('admin');
    Route::patch('stock/{item}/actualizar', 'update')->name('stock.update')->middleware('admin');
});

// Controlador carrito
Route::controller(CartController::class)->group(function(){
    Route::get('carrito', 'checkout')->name('carrito.checkout');
    Route::post('carrito/store', 'store')->name('carrito.store');
    Route::get('carrito/{item}/modificar', 'edit')->name('carrito.edit');
    Route::put('carrito/{item}', 'update')->name('carrito.update');
    Route::delete('carrito/{item}/remover', 'remove')->name('carrito.remove');
    Route::delete('carrito/{carrito}', 'destroy')->name('carrito.destroy');
});

// Controlador ordenes
Route::controller(OrderController::class)->group(function(){
    Route::get('order/pedidos', 'pedidos')->name('order.pedidos');
    Route::get('order/create', 'create')->name('order.create');
    Route::post('order/store', 'store')->name('order.store');
    Route::get('order/checkout', 'checkout')->name('order.checkout')->middleware('admin');
    Route::get('order/{order}', 'show')->name('order.show');
    Route::delete('order/destroy', 'destroy')->name('order.destroy')->middleware('admin');
    //ruta de prueba pago
    Route::get('order/{order}/pay', 'pay')->name('order.pay');
});

// Respuestas mercado pago
Route::post('webhooks', WebhooksController::class)->name('webhooks');
 
//
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

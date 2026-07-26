<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ReportController;

// Inventario
Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::resource('products', ProductController::class);

// Ventas
Route::get('/ventas', [SaleController::class, 'index'])->name('sales.index');
Route::post('/ventas', [SaleController::class, 'store'])->name('sales.store');

// Reportes
Route::get('/reportes', [ReportController::class, 'index'])->name('reports.index');
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de Login y Logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ==========================================
// RUTAS PROTEGIDAS (Requieren iniciar sesión)
// ==========================================
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return redirect()->route('products.index');
    })->name('dashboard');

    // Inventario (Visible para usuarios autenticados)
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    
    // Punto de Venta (Visible para usuarios autenticados)
    Route::get('/sales', [ProductController::class, 'posIndex'])->name('sales.index');
    Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');

    // ==========================================
    // ACCIONES EXCLUSIVAS PARA ADMINISTRADOR
    // ==========================================
    Route::middleware(['can:admin-only'])->group(function () {
        
        // CRUD Productos
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

        // Importar / Exportar
        Route::post('/products/import', [ProductController::class, 'import'])->name('products.import');
        
        // Reportes
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');

        Route::delete('/reports/destroy-by-date', [ReportController::class, 'destroyByDate'])->name('reports.destroyByDate');
    });

});
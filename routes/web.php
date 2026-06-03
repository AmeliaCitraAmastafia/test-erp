<?php

use App\Http\Controllers\InventoryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(match (config('app.service_role')) {
        'laporan' => route('reports.index'),
        'notif' => route('notifications.index'),
        default => route('inventory.index'),
    });
});

Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::post('/inventory/items', [InventoryController::class, 'storeItem'])->name('inventory.items.store');
Route::post('/inventory/movements', [InventoryController::class, 'storeMovement'])->name('inventory.movements.store');

Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/reports/stock/print', [ReportController::class, 'printStock'])->name('reports.stock.print');

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications', [NotificationController::class, 'store'])->name('notifications.store');

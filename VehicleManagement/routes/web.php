<?php

use App\Models\Vehicles;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiclesController;
use App\Models\Maintenance;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\DispatchController;

Route::get('/', function () {
    return view('layouts.dashboard');
})->name('dashboard');

Route::get('/vehicles', [VehiclesController::class, 'index'])->name('vehicles.index');
Route::post('/vehicles', [VehiclesController::class, 'store'])->name('vehicles.store');
Route::put('/vehicles/{vehicle}', [VehiclesController::class, 'update'])->name('vehicles.update');
Route::delete('/vehicles/{vehicle}', [VehiclesController::class, 'destroy'])->name('vehicles.destroy');

// Maintenance Routes
Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');
Route::get('/maintenance/create', [MaintenanceController::class, 'create'])->name('maintenance.create');
Route::get('/maintenance/completed', [MaintenanceController::class, 'completedList'])->name('maintenance.completed');
Route::post('/maintenance', [MaintenanceController::class, 'store'])->name('maintenance.store');
Route::put('/maintenance/{id}', [MaintenanceController::class, 'update'])->name('maintenances.update');
Route::delete('/maintenance/{id}', [MaintenanceController::class, 'destroy'])->name('maintenance.destroy');

// Dispatch Routes
Route::get('/dispatch', [DispatchController::class, 'index'])->name('dispatch.index');
Route::get('/dispatch/create', [DispatchController::class, 'create'])->name('dispatch.create');
Route::post('/dispatch', [DispatchController::class, 'store'])->name('dispatch.store');
Route::delete('/dispatch/{id}', [DispatchController::class, 'destroy'])->name('dispatch.destroy');

Route::get('/dispatch/vehicles_drivers', [DispatchController::class, 'activeList'])->name('dispatch.vehicles_drivers');
Route::get('/driver/driver_profile', [DispatchController::class, 'dispatchDrivers'])->name('driver.prpfile');


// temporary routes
Route::get('/driver', function () {
    return view('driver.driver_report');
})->name('driver.report');
Route::get('/costs', function () {
    return view('cost_optimization.analytics');
})->name('costs.analytics');
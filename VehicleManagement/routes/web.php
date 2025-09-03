<?php

use App\Models\Vehicles;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiclesController;
use App\Models\Maintenance;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\DispatchController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('pages.dashboard') : redirect()->route('auth.login');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('pages.dashboard')->middleware('auth');

// Route::get('/vehicles/maintenance', function () {
//     $vehicles = Vehicles::latest()->get(); // Fetch all vehicles for maintenance view
//     return view('vehicles.maintenance', compact('vehicles'));
// });
Route::get('/login',[AuthController::class, 'login'])->name('auth.login');
Route::post('/login',[AuthController::class, 'loginPost'])->name('auth.login.post');
Route::get('/register',[AuthController::class, 'register'])->name('auth.register');
Route::post('/register',[AuthController::class, 'registerpost'])->name('auth.register.post');
Route::get('/logout',[AuthController::class, 'logout'])->name('logout');



Route::get('/vehicles', [VehiclesController::class, 'index'])->name('vehicles.index');
Route::post('/vehicles', [VehiclesController::class, 'store'])->name('vehicles.store');
Route::put('/vehicles/{vehicle}', [VehiclesController::class, 'update'])->name('vehicles.update');
Route::delete('/vehicles/{vehicle}', [VehiclesController::class, 'destroy'])->name('vehicles.destroy');

// Maintenance Routes
Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');
Route::get('/maintenance/create', [MaintenanceController::class, 'create'])->name('maintenance.create');
Route::get('/maintenance/completed', [MaintenanceController::class, 'completedList'])->name('maintenances.completed');
Route::post('/maintenance', [MaintenanceController::class, 'store'])->name('maintenance.store');
Route::put('/maintenance/{id}', [MaintenanceController::class, 'update'])->name('maintenances.update');
Route::delete('/maintenance/{id}', [MaintenanceController::class, 'destroy'])->name('maintenance.destroy');

// Dispatch Routes
Route::get('/dispatch', [DispatchController::class, 'index'])->name('dispatch.index');
Route::get('/dispatch/create', [DispatchController::class, 'create'])->name('dispatch.create');
Route::post('/dispatch', [DispatchController::class, 'store'])->name('dispatch.store');
Route::delete('/dispatch/{id}', [DispatchController::class, 'destroy'])->name('dispatch.destroy');

Route::get('/dispatch/vehicles_drivers', [DispatchController::class, 'activeList'])->name('dispatch.vehicles_drivers');


Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('pages.dashboard');


Route::get('/Maintenance', function () {
    return view('pages.Maintenance');
})->name('pages.Maintenance');

Route::get('/vehiclemanagement', function () {
    return view('pages.vehiclemanagement');
})->name('pages.vehiclemanagement');

Route::get('/metrics', function () {
    return view('pages.metrics');
})->name('pages.metrics');


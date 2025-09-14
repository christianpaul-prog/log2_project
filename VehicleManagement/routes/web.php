<?php

use App\Models\Vehicles;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiclesController;
use App\Models\Maintenance;
use App\Models\Reservation;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VehiclesreportController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\CostAnalysisController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BudgetForecastingController;



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
Route::get('/maintenance/completed', [MaintenanceController::class, 'completedList'])->name('maintenance.completed');
Route::post('/maintenance', [MaintenanceController::class, 'store'])->name('maintenance.store');
Route::put('/maintenance/{id}', [MaintenanceController::class, 'update'])->name('maintenances.update');
Route::delete('/maintenance/{id}', [MaintenanceController::class, 'destroy'])->name('maintenance.destroy');

// // Dispatch Routes
// Route::get('/dispatch', [DispatchController::class, 'index'])->name('dispatch.index');
// Route::get('/dispatch/create', [DispatchController::class, 'create'])->name('dispatch.create');
// Route::post('/dispatch', [DispatchController::class, 'store'])->name('dispatch.store');
// Route::delete('/dispatch/{id}', [DispatchController::class, 'destroy'])->name('dispatch.destroy');

//Route::get('/dispatch/vehicles_drivers', [DispatchController::class, 'activeList'])->name('dispatch.vehicles_drivers');
//Route::get('/driver/driver_profile', [DispatchController::class, 'dispatchDrivers'])->name('driver.driver_profile');

// reservation routes
Route::get('/reservation',[ReservationController::class,'index'])->name('reservation.index');
Route::get('/reservation/create',[ReservationController::class,'create'])->name('reservation.create');
Route::post('/reservation',[ReservationController::class,'store'])->name('reservation.store');
Route::put('/reservation/{reservation}', [ReservationController::class, 'update'])->name('reservation.update');
Route::delete('/reservation/{reservation}', [ReservationController::class, 'destroy'])->name('reservation.destroy');

// Trip routes
Route::get('/dispatch',[TripController::class,'index'])->name('trip.index');
Route::get('/dispatch/create', [TripController::class, 'create'])->name('trip.create');
Route::post('/dispatch',[TripController::class,'store'])->name('trip.store');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('pages.dashboard');

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


// temporary routes
Route::get('/driver', function () {
    return view('driver.driver_report');
})->name('driver.driver_report');
Route::get('/costs', function () {
    return view('cost_optimization.analytics');
})->name('cost_optimization.analytics');

//fuel-cost//
Route::get('/fuelcost', function () {
    return view('fuelcost.fuel-cost');
})->name('fuelcost.fuel-cost');

Route::prefix('reports')->as('reports.')->group(function () {
    Route::resource('vehiclereport', VehiclesreportController::class)->parameters([
        'vehiclereport' => 'vehicle'
    ]);
});




    Route::resource('costanalysis', CostAnalysisController::class);
Route::delete('/costanalysis/{costanalysis}', [CostAnalysisController::class, 'destroy'])
     ->name('costanalysis.destroy');



Route::get('/trips', function () {
    return view('trips.tripperformance');
})->name('trips.tripperformance');

Route::get('/budget-forecasting', [BudgetForecastingController::class, 'index'])->name('budget_forecasting.index');
Route::post('/budget-forecasting/store', [BudgetForecastingController::class, 'store'])->name('budget_forecasting.store');

// Finance approval routes
Route::post('/budget-forecasting/{id}/approve', [BudgetForecastingController::class, 'approve'])->name('budget_forecasting.approve');
Route::post('/budget-forecasting/{id}/reject', [BudgetForecastingController::class, 'reject'])->name('budget_forecasting.reject');

Route::delete('/notifications/{id}', [CostAnalysisController::class, 'destroyNotification'])
    ->name('notifications.destroy');

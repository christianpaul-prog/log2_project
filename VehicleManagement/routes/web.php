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
Route::view('/terms', 'auth.terms')->name('auth.terms');
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
Route::put('/maintenance/{id}/complete', [MaintenanceController::class, 'complete'])->name('maintenance.complete');
Route::delete('/maintenance/{id}', [MaintenanceController::class, 'destroy'])->name('maintenance.destroy');

// reservation routes
Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation.index');
Route::get('/reservation/create', [ReservationController::class, 'create'])->name('reservation.create');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');
Route::put('/reservation/{reservation}', [ReservationController::class, 'update'])->name('reservation.update');
Route::delete('/reservation/{reservation}', [ReservationController::class, 'destroy'])->name('reservation.destroy');

// Trip routes
Route::get('/dispatch', [TripController::class, 'index'])->name('trip.index');
Route::get('/dispatch/create', [TripController::class, 'create'])->name('trip.create');
Route::post('/dispatch', [TripController::class, 'store'])->name('trip.store');
Route::post('/dispatch/{id}/reject', [TripController::class, 'reject'])->name('trip.reject');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('pages.dashboard');


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
Route::get('/costs', function () {
    return view('cost_optimization.analytics');
})->name('cost_optimization.analytics');

Route::resource('costanalysis', CostAnalysisController::class);
Route::delete('/costanalysis/{costanalysis}', [CostAnalysisController::class, 'destroy'])
    ->name('costanalysis.destroy');
    Route::patch('/costanalysis/{id}/close', [CostAnalysisController::class, 'close'])->name('costanalysis.close');


Route::get('/trips', [DashboardController::class, 'performance'])->name('trips.performance');
Route::get('/driver', [DashboardController::class, 'report'])->name('driver.report');



// Budget Forecasting routes
Route::get('/budget-forecasting', [BudgetForecastingController::class, 'index'])->name('budget_forecasting.index');
Route::post('/budget-forecasting/store', [BudgetForecastingController::class, 'store'])->name('budget_forecasting.store');

// Finance approval routes
Route::post('/budget-forecasting/{id}/approve', [BudgetForecastingController::class, 'approve'])->name('budget_forecasting.approve');
Route::post('/budget-forecasting/{id}/reject', [BudgetForecastingController::class, 'reject'])->name('budget_forecasting.reject');
Route::delete('/budget-forecasting/{id}', [BudgetForecastingController::class, 'destroy'])->name('budget_forecasting.destroy');
// Notification routes
Route::delete('/notifications/{id}', [CostAnalysisController::class, 'destroyNotification'])
    ->name('notifications.destroy');
    Route::delete('/notifications/{id}', [DashboardController::class, 'destroyNotification'])
    ->name('notifications.destroy');

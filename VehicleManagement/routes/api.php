<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Api\VehiclesApiController;
Route::apiResource('vehicles', VehiclesApiController::class);

use App\Http\Controllers\Api\ReservationsApiController;
Route::apiResource('reservations', ReservationsApiController::class);

use App\Http\Controllers\Api\TripsApiController;
Route::apiResource('trips', TripsApiController::class);
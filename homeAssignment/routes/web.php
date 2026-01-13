<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/vehicles');
});

Route::resource('vehicles', App\Http\Controllers\VehicleController::class);
Route::resource('manufacturers', App\Http\Controllers\ManufacturerController::class);
Route::resource('weapons', App\Http\Controllers\WeaponController::class);
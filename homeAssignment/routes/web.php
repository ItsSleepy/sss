<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/vehicles');
});

Route::resource('vehicles', App\Http\Controllers\VehicleController::class);
Route::resource('manufacturers', App\Http\Controllers\ManufacturerController::class);
Route::resource('weapons', App\Http\Controllers\WeaponController::class);

Route::get('vehicles/{id}/armament', [App\Http\Controllers\VehicleController::class, 'armament'])->name('vehicles.armament');
Route::post('vehicles/{id}/armament', [App\Http\Controllers\VehicleController::class, 'armamentStore'])->name('vehicles.armament.store');
Route::delete('vehicles/{vehicle}/armament/{config}', [App\Http\Controllers\VehicleController::class, 'armamentDestroy'])->name('vehicles.armament.destroy');
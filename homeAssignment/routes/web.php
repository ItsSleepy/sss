<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/vehicles');
});

Route::resource('vehicles', App\Http\Controllers\VehicleController::class);
Route::resource('manufacturers', App\Http\Controllers\ManufacturerController::class);
Route::resource('weapons', App\Http\Controllers\WeaponController::class);
<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TruckController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::resource('trucks', TruckController::class)
    ->parameters(['trucks' => 'id']);

Route::resource('routes', RouteController::class)
    ->parameters(['routes' => 'id']);

Route::resource('companies', CompanyController::class)
    ->parameters(['companies' => 'id']);

Route::resource('addresses', AddressController::class)
    ->parameters(['addresses' => 'id']);

Route::view('testo', 'components.table');

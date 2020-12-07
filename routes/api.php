<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TransactionController;


Route::post('login', [LoginController::class, 'spalogin']);
Route::get('logout', [LoginController::class, 'spalogout'])->middleware('auth:sanctum');
Route::get('dashboard', [DashboardController::class, 'apiindex'])->middleware('auth:sanctum');

Route::get('client', [ClientController::class, 'apiindex'])->middleware('auth:sanctum');
Route::get('transaction', [TransactionController::class, 'apiindex'])->middleware('auth:sanctum');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/spa', function () {
    return view('spa');
});

Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::get('/logout', function(){
    Auth::logout();
    return redirect('login');
})->name('logout')->middleware('auth');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
// Route::post('client', [ClientController::class, 'store'])->middleware('auth');
// Route::get('/client', [ClientController::class, 'index'])->middleware('auth');
// Route::get('/client/create', [ClientController::class, 'create'])->middleware('auth');
// Route::get('/client/{client}', [ClientController::class, 'show'])->middleware('auth');

Route::resource('client' , ClientController::class)->middleware('auth');
// Route::get('transaction', [TransactionController::class, 'index'])->middleware('auth');
// Route::post('transaction', [TransactionController::class, 'store'])->middleware('auth');
// Route::get('transaction/{transaction}', [TransactionController::class, 'show'])->middleware('auth');

Route::resource('transaction' , TransactionController::class)->middleware('auth');
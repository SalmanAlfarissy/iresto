<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MyWalletController;
use Illuminate\Support\Facades\Route;

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

Route::get('login', function () {
    return view('login');
});
Route::get('transaction', function () {
    return view('transaction.index');
});
Route::get('ledgerbalence', function () {
    return view('ledgerbalence.index');
});

Route::get('user', function () {
    return view('user.index');
});

Route::get('/', [DashboardController::class,'index'])->name('dashboard');
Route::get('/mywallet', [MyWalletController::class,'index'])->name('topup');
Route::get('/payment', [MyWalletController::class,'payment'])->name('topup-payment');
Route::post('/datatransaksi', [MyWalletController::class,'dataTransaksi'])->name('topup-datatransaksi');

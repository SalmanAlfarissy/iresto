<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DebetController;
use App\Http\Controllers\KreditController;
use App\Http\Controllers\LedgerBalanceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MyWalletController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return redirect(route('login'));
});

//login
Route::get('login', [LoginController::class,'index'])->name('login');
Route::post('authuser', [LoginController::class,'authUser'])->name('login-authUser');

//logout
Route::get('logout', [LoginController::class,'logout'])->name('logout');

//Admin
Route::group(['middleware'=>['checkLevel:admin,user,customer']], function () {
    Route::group(['middleware'=>['checkLevel:admin,user']], function(){
        Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
    });

    Route::group(['middleware'=>['checkLevel:admin'], 'prefix'=>'user'] ,function () {
        Route::get('/', [UserController::class,'index'])->name('user');
        Route::get('getdata', [UserController::class,'getData'])->name('user-getData');
        Route::post('create', [UserController::class,'create'])->name('user-create');
        Route::post('update/{id}', [UserController::class,'update'])->name('user-update');
        Route::post('delete/{id}', [UserController::class,'delete'])->name('user-delete');
    });

    Route::prefix('ledger-balance')->group(function () {
        Route::get('/', [LedgerBalanceController::class,'index'])->name('ledger-balance');
        Route::get('getData', [LedgerBalanceController::class,'getData'])->name('ledger-balance-getData');
    });

    //customer
    Route::middleware(['checkLevel:customer'])->group(function () {
        Route::prefix('mywallet')->group(function () {
            Route::get('/', [MyWalletController::class,'index'])->name('mywallet');
            Route::post('payment', [MyWalletController::class,'payment'])->name('mywallet-payment');
        });

        Route::prefix('transaction')->group(function () {
            Route::get('/', [TransactionController::class,'index'])->name('transaction');
            Route::get('getData', [TransactionController::class,'getData'])->name('transaction-getData');
            Route::post('create', [TransactionController::class,'create'])->name('transaction-create');
        });

        Route::prefix('kredit')->group(function () {
            Route::post('create', [KreditController::class,'create'])->name('kredit-create');
        });

        Route::prefix('debet')->group(function () {
            Route::post('create', [DebetController::class,'create'])->name('debet-create');
        });
    });
});





<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MyWalletController;
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

    Route::middleware(['checkLevel:customer'])->group(function () {
        Route::prefix('mywallet')->group(function () {
            Route::get('/', [MyWalletController::class,'index'])->name('mywallet');

        });
    });
});

//customer




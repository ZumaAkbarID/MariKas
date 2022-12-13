<?php

use App\Http\Controllers\Auth\Activation as AuthActivation;
use App\Http\Controllers\Auth\Register as AuthRegister;
use App\Http\Controllers\Auth\Login as AuthLogin;
use App\Http\Controllers\Auth\Logout as AuthLogout;
use App\Http\Controllers\Dashboard\Dashboard;
use App\Jobs\SendOtp;
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

Route::group(['middleware' => ['auth', 'isWaActive']], function () {
    Route::get('/', [Dashboard::class, 'index'])->name('Dashboard');
});

Route::group(['middleware' => 'guest', 'prefix' => 'auth'], function () {
    Route::get('register', [AuthRegister::class, 'form'])->name('Auth_register');
    Route::post('register', [AuthRegister::class, 'process']);

    Route::get('login', [AuthLogin::class, 'form'])->name('Auth_login');
    Route::post('login', [AuthLogin::class, 'process']);
});

Route::group(['middleware' => ['auth'], 'prefix' => 'auth'], function () {
    Route::get('logout', [AuthLogout::class, 'process'])->name('Auth_logout');
});

Route::group(['middleware' => ['auth', 'isWaNonActive'], 'prefix' => 'auth'], function () {
    Route::get('send/otp', [AuthActivation::class, 'send_otp'])->name('Auth_send_otp');
    Route::get('activation', [AuthActivation::class, 'form'])->name('Auth_activation');
    Route::post('activation', [AuthActivation::class, 'process']);
});
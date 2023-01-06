<?php

use App\Http\Controllers\API\FastWA\Connect as APIFastWaConnect;
use App\Http\Controllers\Auth\Activation as AuthActivation;
use App\Http\Controllers\Auth\Register as AuthRegister;
use App\Http\Controllers\Auth\Login as AuthLogin;
use App\Http\Controllers\Auth\Logout as AuthLogout;
use App\Http\Controllers\Dashboard\Dashboard;
use App\Http\Controllers\PayKas;
use App\Http\Controllers\Pemilik\Tripay as PemilikTripay;
use App\Http\Controllers\Pemilik\Approval as PemilikApproval;
use App\Http\Controllers\Pemilik\Cashout as PemilikCashout;
use App\Http\Controllers\Pemilik\Manual as PemilikManual;
use App\Http\Controllers\PublicKas;
use App\Http\Controllers\Tripay\Calc;
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

Route::get('/', [PayKas::class, 'form'])->name('Pay_Manual');
Route::post('/', [PayKas::class, 'process']);

Route::post('/api/tripay/calc-price', [Calc::class, 'price'])->name('Tripay_Calc_Price');

Route::get('kas', [PublicKas::class, 'index'])->name('Kas_Index');

Route::group(['middleware' => ['auth', 'isWaActive']], function () {
    Route::get('dashboard', [Dashboard::class, 'index'])->name('Dashboard');

    Route::get('/notif', function () {
        return 'All';
    })->name('Notif_All');
    Route::get('/notif/read/{$id}', function ($id) {
        return $id;
    })->name('Notif_Read');
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

Route::group(['middleware' => ['isPemilik', 'auth', 'isWaActive'], 'prefix' => 'pengurus'], function () {
    Route::get('manual', [PemilikManual::class, 'form'])->name('Pemilik_Manual');
    Route::post('manual', [PemilikManual::class, 'process']);

    Route::get('approval', [PemilikApproval::class, 'index'])->name('Pemilik_Approval');
    Route::post('approve', [PemilikApproval::class, 'approve'])->name('Pemilik_Ajax_Approve');
    Route::post('reject', [PemilikApproval::class, 'reject'])->name('Pemilik_Ajax_Reject');

    Route::get('cashout', [PemilikCashout::class, 'index'])->name('Pemilik_Cashout');
    Route::post('cashout', [PemilikCashout::class, 'process']);

    Route::get('tripay', [PemilikTripay::class, 'index'])->name('Pemilik_Tripay');
});

Route::group(['middleware' => 'isDev', 'prefix' => 'dev'], function () {
    Route::group(['prefix' => 'api'], function () {
        Route::get('fastwa/connect', [APIFastWaConnect::class, 'index'])->name('API_FastWa_Connect');
    });
});
<?php

use App\Http\Controllers\API\FastWA\Connect as APIFastWaConnect;
use App\Http\Controllers\Auth\Activation as AuthActivation;
use App\Http\Controllers\Auth\ForgotPassword as AuthForgotPassword;
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

// DEV MODE

Route::get('/webhook', function () {
    dd(send_dc_webhook('otp-webhook', [
        [
            'name' => 'Name 1',
            'value' => 'Value Name 1',
            'inine' => false,
        ],
        [
            'name' => 'Name 2',
            'value' => 'Value Name 2',
            'inine' => false,
        ]
    ], 'https://media.licdn.com/dms/image/D4E03AQHldbRDe9nkHQ/profile-displayphoto-shrink_800_800/0/1663714598883?e=2147483647&v=beta&t=j7SAQAY5alsAhM9IKyNVFHnve2hEpdySIBgeTUNM0ac'));
});

// END DEV MODE

Route::get('/', [PayKas::class, 'form'])->name('Pay_Manual');
Route::post('/', [PayKas::class, 'process']);
Route::post('/api/tripay/calc-price', [Calc::class, 'price'])->name('Tripay_Calc_Price');

Route::get('kalendar', [PublicKas::class, 'index'])->name('Kas_Index');
Route::get('kas', [PublicKas::class, 'kas_eachmonth'])->name('Kas_EachMonth');

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

Route::group(['prefix' => 'auth'], function () {
    Route::get('reset-password', [AuthForgotPassword::class, 'index'])->name('Auth_forgot_index');
    Route::post('reset-password', [AuthForgotPassword::class, 'otp'])->name('Auth_forgot_otp');
    Route::post('reset-password/process', [AuthForgotPassword::class, 'process'])->name('Auth_forgot_process');
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
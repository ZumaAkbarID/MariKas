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
use App\Http\Controllers\Profile\Settings as ProfileSettings;
use App\Http\Controllers\Profile\User as ProfileUser;
use App\Http\Controllers\PublicKas;
use App\Http\Controllers\Tripay\Calc;
use App\Http\Controllers\Website\Config as WebConfig;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/zuma-1', function () {
    return Artisan::call('storage:link');
});
Route::get('/zuma-2', function () {
    return Artisan::call('migrate:fresh --seed');
});

// END DEV MODE

Route::get('/', [PayKas::class, 'form'])->name('Pay_Manual');
Route::post('/', [PayKas::class, 'process']);
Route::post('/get-phone', [PayKas::class, 'get_phone'])->name('Get_Phone');
Route::post('/api/tripay/calc-price', [Calc::class, 'price'])->name('Tripay_Calc_Price');

Route::get('kalendar', [PublicKas::class, 'index'])->name('Kas_Index');
Route::get('kas', [PublicKas::class, 'kas_eachmonth'])->name('Kas_EachMonth');

Route::group(['middleware' => ['auth', 'isWaActive']], function () {
    Route::get('dashboard', [Dashboard::class, 'index'])->name('Dashboard');

    Route::get('/notif', function () {
        return 'Coming Soon';
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

Route::group(['middleware' => ['auth', 'isWaActive'], 'prefix' => 'profile'], function () {
    Route::get('', [ProfileUser::class, 'index'])->name('Profile_index');
    Route::post('', [ProfileUser::class, 'process']);

    Route::get('setting', [ProfileSettings::class, 'index'])->name('Profile_settings');
    Route::post('setting', [ProfileSettings::class, 'process']);
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

    Route::group(['prefix' => 'config'], function () {
        Route::get('website', [WebConfig::class, 'index'])->name('WebConfig_index');
        Route::post('website', [WebConfig::class, 'update']);
    });
});

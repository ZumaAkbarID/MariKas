<?php

use App\Http\Controllers\Auth\Activation as AuthActivation;
use App\Http\Controllers\Auth\Register as AuthRegister;
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

Route::get('/', function () {
    return view('welcome');
})->middleware('isWaActive');

Route::get('send', function () {
    dispatch(new SendOtp(1, '081225389903'));
    return 'ok';
});

Route::group(['middleware' => 'guest', 'prefix' => 'auth'], function () {
    Route::get('register', [AuthRegister::class, 'form'])->name('Auth_register');
    Route::post('register', [AuthRegister::class, 'process']);
});

Route::group(['middleware' => 'auth', 'prefix' => 'auth'], function () {
    Route::get('activation', [AuthActivation::class, 'form'])->name('Auth_activation');
    Route::post('activation', [AuthActivation::class, 'process']);
});
<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\RecoverPassword;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
| Here is where you can register authentication routes for your web.
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
| To access this endpoint, the prefix 'auth' has to be added.
| You can change this in the RouteServiceProvider file
|
*/

//login route
Route::get('login',[Login::class,'landingPage'])->name('login');//login landing page
Route::post('check-login',[Login::class,'authenticate'])->name('auth.login');//process login
Route::get('verify-login/{email}/{hash}',[Login::class,'processTwoFactor'])->name('auth.twoFactor');//verify login
//registration route
Route::get('register',[Register::class,'landingPage'])->name('register');//registration landing page
Route::post('register',[Register::class,'authenticate'])->name('auth.register');//process registration
Route::get('verify-email/{email}/{hash}',[Register::class,'processVerifyEmail'])->name('emailVerification');//verify email
//recover password
Route::get('recover-password',[RecoverPassword::class,'landingPage'])->name('forgotPassword');//recover password
Route::post('recover-password',[RecoverPassword::class,'authenticate'])->name('recoverPassword');// authenticate
Route::get('recover-password/{email}/{hash}',[RecoverPassword::class,'verifyRequest'])->name('verifyReset');
Route::post('reset-password',[RecoverPassword::class,'resetPassword'])->name('resetPassword');//reset the password

<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\RecoverPassword;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Transactions;
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

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('index',[HomeController::class,'index'])->name('home1');
Route::get('about',[HomeController::class,'about']);
Route::get('plans',[HomeController::class,'plans']);
Route::get('terms',[HomeController::class,'terms']);
Route::get('privacy',[HomeController::class,'privacy']);
Route::get('faqs',[HomeController::class,'faqs']);
Route::get('contact',[HomeController::class,'contact']);
Route::get('service',[HomeController::class,'service']);
Route::get('service/{id}',[HomeController::class,'serviceDetail'])->name('service_detail');
Route::get('markets',[HomeController::class,'markets']);

Route::post('transactions/incoming/{customId}/account/{accountId}',[Transactions::class,'incoming']);
